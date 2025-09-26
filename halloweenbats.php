<?php
/**
 * 2009-2025 Tecnoacquisti.com
 *
 * For support feel free to contact us on our website at http://www.tecnoacquisti.com
 *
 * @author    Arte e Informatica <helpdesk@tecnoacquisti.com>
 * @copyright 2009-2025 Arte e Informatica
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @version   1.0.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class halloweenbats extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'halloweenbats';
        $this->tab = 'front_office_features';
        $this->version = '1.0.2';
        $this->author = 'Tecnoacquisti.com';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Art Halloween Bats');
        $this->description = $this->l('For Halloween add a pleasing flock of bats that flutter on the pages of your ecommerce site.');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {

        return parent::install() &&
		Configuration::updateValue('HALLOWEEN_JQUERY', 0) &&
		Configuration::updateValue('HALLOWEEN_AMOUNT', 5) &&
		Configuration::updateValue('HALLOWEEN_SPEED', 20) &&
        $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return Configuration::deleteByName('HALLOWEEN_JQUERY') &&
		Configuration::deleteByName('HALLOWEEN_AMOUNT') &&
		Configuration::deleteByName('HALLOWEEN_SPEED') &&
        parent::uninstall();
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
		
		$output = null;
		$this->_errors = array();
        $useSsl = (bool)Configuration::get('PS_SSL_ENABLED_EVERYWHERE') || (bool)Configuration::get('PS_SSL_ENABLED');
        $shop_base_url = $this->context->link->getBaseLink((int)$this->context->shop->id, $useSsl);
        
        if (((bool)Tools::isSubmit('submitHalloweenBats')) == true) {
			
			$halloween_jquery = Tools::getValue('HALLOWEEN_JQUERY');
            $halloween_amount = Tools::getValue('HALLOWEEN_AMOUNT');
			$halloween_speed = Tools::getValue('HALLOWEEN_SPEED');
			
			if (!is_numeric($halloween_amount) || $halloween_amount <= 0) {
				$this->_errors[] = '['.$halloween_amount.'] '.$this->l('it is not a valid number for Bats amount');
			} elseif (!is_numeric($halloween_speed) || $halloween_speed <= 0) {
				$this->_errors[] = '['.$halloween_speed.'] '.$this->l('it is not a valid number for Bats speed');
			}
			
			if (!count($this->_errors)){		
			Configuration::updateValue('HALLOWEEN_JQUERY', (int)$halloween_jquery);
			Configuration::updateValue('HALLOWEEN_AMOUNT', (int)$halloween_amount);
			Configuration::updateValue('HALLOWEEN_SPEED', (int)$halloween_speed);
						
			$this->_clearCache('halloween_bats.tpl');
		    $output .= $this->displayConfirmation($this->l('Settings updated'));
			} else {
				
			foreach ($this->_errors as $error)
					$errors = $error.' '.$this->l('Settings failed');
				$output .= $this->displayError($errors);	
			}
		
		
		}

        $this->context->smarty->assign(array(
            'shop_base_url' => $shop_base_url,
        ));

        $output .= $this->renderForm();
        $output .= $this->context->smarty->fetch($this->local_path . 'views/templates/admin/copyright.tpl');
        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitHalloweenBats';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Load jQUERY'),
                        'name' => 'HALLOWEEN_JQUERY',
                        'is_bool' => true,
                        'desc' => $this->l('If your theme does not load jQUERY'),
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
					array(
						'col' => 2,
                        'type' => 'text',
                        'label' => $this->l('Bat amount'),
                        'name' => 'HALLOWEEN_AMOUNT',
                        'autoload_rte' => true,
                        'desc' => $this->l('Number of bats to show (default 5)'),
                    ),
					array(
						'col' => 2,
                        'type' => 'text',
                        'label' => $this->l('Speed'),
                        'name' => 'HALLOWEEN_SPEED',
                        'autoload_rte' => true,
                        'desc' => $this->l('Higher value = faster (default 20)'),
                    ),
                    
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        return array(
			'HALLOWEEN_JQUERY' => Tools::getValue('HALLOWEEN_JQUERY', Configuration::get('HALLOWEEN_JQUERY')),
			'HALLOWEEN_AMOUNT' => Tools::getValue('HALLOWEEN_AMOUNT', Configuration::get('HALLOWEEN_AMOUNT')),
			'HALLOWEEN_SPEED' => Tools::getValue('HALLOWEEN_SPEED', Configuration::get('HALLOWEEN_SPEED')),
        );
    }

   

    public function hookDisplayHeader()
    {

		$arturi = Tools::getHttpHost(true).__PS_BASE_URI__;
		$this->context->controller->addJS($this->_path.'/views/js/halloween-bats.js');
        $this->context->controller->addCSS($this->_path.'/views/css/halloween-bats.css');
		$bats_url = $arturi.'modules/halloweenbats/views/img/bats.png';
		
		$hw_jquery = (int)Configuration::get('HALLOWEEN_JQUERY');
		$bats_amount = (int)Configuration::get('HALLOWEEN_AMOUNT');
		$bats_speed = (int)Configuration::get('HALLOWEEN_SPEED');
				
		if ($bats_amount <= 0) {
			$bats_amount = 5;
		}
	
		if ($bats_speed <= 0) {
			$bats_speed = 20;
		}
		
		$this->smarty->assign(array(
				'bats_url' => $bats_url,
				'bats_amount' => $bats_amount,
				'bats_speed' => $bats_speed,
				'hw_jquery' => $hw_jquery,
				'arturi' => $arturi,
		));
		
		return $this->display(__FILE__, 'halloween_bats.tpl');
    }
}
