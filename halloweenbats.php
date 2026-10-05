<?php
/**
 * 2009-2026 Tecnoacquisti.com
 *
 * For support feel free to contact us on our website at http://www.tecnoacquisti.com
 *
 * @author    Arte e Informatica <helpdesk@tecnoacquisti.com>
 * @copyright 2009-2026 Arte e Informatica
 * @license   https://opensource.org/licenses/MIT MIT License; see LICENSE
 * @version   1.1.0
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
        $this->version = '1.1.0';
        $this->author = 'Tecnoacquisti.com';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Art Halloween Bats');
        $this->description = $this->l('For Halloween add a pleasing flock of bats that flutter on the pages of your ecommerce site.');

        $this->ps_versions_compliancy = ['min' => '1.6', 'max' => _PS_VERSION_];
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {

        return parent::install() &&
		Configuration::updateValue('HALLOWEEN_ENGINE', 'vanilla') &&
        Configuration::updateValue('HALLOWEEN_JQUERY', 0) &&
		Configuration::updateValue('HALLOWEEN_AMOUNT', 5) &&
		Configuration::updateValue('HALLOWEEN_SPEED', 20) &&
        $this->registerHook('displayHeader');
    }

    public function uninstall()
    {
        return Configuration::deleteByName('HALLOWEEN_ENGINE') &&
        Configuration::deleteByName('HALLOWEEN_JQUERY') &&
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
		$this->_errors = [];
        $useSsl = (bool)Configuration::get('PS_SSL_ENABLED_EVERYWHERE') || (bool)Configuration::get('PS_SSL_ENABLED');
        $shop_base_url = $this->context->link->getBaseLink((int)$this->context->shop->id, $useSsl);

        if (Tools::isSubmit('submitHalloweenBats')) {
            $engine = Tools::getValue('HALLOWEEN_ENGINE');
            $jquery = Tools::getValue('HALLOWEEN_JQUERY');
            $amount = Tools::getValue('HALLOWEEN_AMOUNT');
            $speed = Tools::getValue('HALLOWEEN_SPEED');
            if (!in_array($engine, ['vanilla', 'jquery'], true)) {
                $this->_errors[] = $this->l('Select a valid animation engine.');
            }
            if (!in_array($jquery, ['0', '1', 0, 1], true)) {
                $this->_errors[] = $this->l('Select a valid jQuery loading option.');
            }
            if (!$this->isValidAnimationNumber($amount)) {
                $this->_errors[] = $this->l('Bat amount must be a whole number between 1 and 100.');
            }
            if (!$this->isValidAnimationNumber($speed)) {
                $this->_errors[] = $this->l('Speed must be a whole number between 1 and 100.');
            }
            if (!$this->_errors) {
                $saved = Configuration::updateValue('HALLOWEEN_ENGINE', $engine)
                    && Configuration::updateValue('HALLOWEEN_JQUERY', (int) $jquery)
                    && Configuration::updateValue('HALLOWEEN_AMOUNT', (int) $amount)
                    && Configuration::updateValue('HALLOWEEN_SPEED', (int) $speed);
                $output .= $saved
                    ? $this->displayConfirmation($this->l('Settings updated'))
                    : $this->displayError($this->l('Settings failed'));
            } else {
                foreach ($this->_errors as $error) {
                    $output .= $this->displayError($error);
                }
            }
        }

        $this->context->smarty->assign([
            'shop_base_url' => $shop_base_url,
        ]);

        $this->context->controller->addJS($this->_path . 'views/js/admin.js');
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

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of your form.
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'select',
                        'label' => $this->l('Animation engine'),
                        'name' => 'HALLOWEEN_ENGINE',
                        'options' => [
                            'query' => [
                                ['id' => 'vanilla', 'name' => $this->l('Vanilla JavaScript')],
                                ['id' => 'jquery', 'name' => $this->l('jQuery')],
                            ],
                            'id' => 'id',
                            'name' => 'name',
                        ],
                        'desc' => $this->l('Vanilla works without jQuery. Existing installations keep jQuery until changed.'),
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Load jQUERY'),
                        'name' => 'HALLOWEEN_JQUERY',
                        'is_bool' => true,
                        'desc' => $this->l('Only used with the jQuery engine when the theme does not provide jQuery.'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            ]
                        ],
                    ],
					[
						'col' => 2,
                        'type' => 'text',
                        'label' => $this->l('Bat amount'),
                        'name' => 'HALLOWEEN_AMOUNT',
                        'maxlength' => 3,
                        'class' => 'halloween-number',
                        'desc' => $this->l('Number of bats: 1 to 100 (default 5).'),
                    ],
					[
						'col' => 2,
                        'type' => 'text',
                        'label' => $this->l('Speed'),
                        'name' => 'HALLOWEEN_SPEED',
                        'maxlength' => 3,
                        'class' => 'halloween-number',
                        'desc' => $this->l('Speed: 1 to 100; higher is faster (default 20).'),
                    ],

                ],
                'submit' => [
                    'title' => $this->l('Save'),
                ],
            ],
        ];
    }

    /**
     * Set values for the inputs.
     */
    protected function getConfigFormValues()
    {
        $values = [
            'HALLOWEEN_ENGINE' => $this->getAnimationEngine(),
            'HALLOWEEN_JQUERY' => (int) Configuration::get('HALLOWEEN_JQUERY') === 1 ? 1 : 0,
            'HALLOWEEN_AMOUNT' => $this->getAnimationNumber('HALLOWEEN_AMOUNT', 5),
            'HALLOWEEN_SPEED' => $this->getAnimationNumber('HALLOWEEN_SPEED', 20),
        ];
        foreach ($values as $key => $fallback) {
            $submitted = Tools::getValue($key, $fallback);
            if (is_string($submitted) || is_int($submitted)) {
                $values[$key] = substr((string) $submitted, 0, 100);
            }
        }

        return $values;
    }

    /**
     * Preserve the historical engine when no engine has been configured.
     *
     * @return string
     */
    protected function getAnimationEngine()
    {
        return Configuration::get('HALLOWEEN_ENGINE') === 'vanilla' ? 'vanilla' : 'jquery';
    }

    /**
     * Validate bounded decimal input before persistence and rendering.
     *
     * @param mixed $value
     *
     * @return bool
     */
    protected function isValidAnimationNumber($value)
    {
        return (is_string($value) || is_int($value))
            && preg_match('/^[0-9]{1,3}$/D', (string) $value)
            && (int) $value >= 1 && (int) $value <= 100;
    }

    /**
     * @param string $key
     * @param int $fallback
     *
     * @return int
     */
    protected function getAnimationNumber($key, $fallback)
    {
        $value = Configuration::get($key);

        return $this->isValidAnimationNumber($value) ? (int) $value : $fallback;
    }

    /**
     * Render only the selected engine and its minimal configuration.
     *
     * @return string
     */
    public function hookDisplayHeader()
    {
        $engine = $this->getAnimationEngine();
        $this->context->smarty->assign([
            'bats_engine' => $engine,
            'bats_module_path' => $this->_path,
            'bats_amount' => $this->getAnimationNumber('HALLOWEEN_AMOUNT', 5),
            'bats_speed' => $this->getAnimationNumber('HALLOWEEN_SPEED', 20),
            'hw_jquery' => $engine === 'jquery' && (int) Configuration::get('HALLOWEEN_JQUERY') === 1,
        ]);

        return $this->display(__FILE__, 'views/templates/hook/halloween_bats.tpl');
    }
}
