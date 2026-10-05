{*
**
*  2009-2026 Arte e Informatica
*
*  For support feel free to contact us on our website at https://www.arteinformatica.eu
*
*  @author    Arte e Informatica <admin@arteinformatica.eu>
*  @copyright 2009-2026 Arte e Informatica
*  @version   2.1
*  @license   https://opensource.org/licenses/MIT MIT License; see LICENSE
*
*}

{if $hw_jquery}
  <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{/if}
{if $bats_engine == 'vanilla'}
  <script defer src="{$bats_module_path|escape:'html':'UTF-8'}views/js/vanilla-bats.js"></script>
{else}
  <script defer src="{$bats_module_path|escape:'html':'UTF-8'}views/js/halloween-bats.js"></script>
{/if}
<script defer id="halloween-bats-config"
        src="{$bats_module_path|escape:'html':'UTF-8'}views/js/init.js"
        data-engine="{$bats_engine|escape:'html':'UTF-8'}"
        data-image="{$bats_module_path|escape:'html':'UTF-8'}views/img/bats.png"
        data-amount="{$bats_amount|intval}"
        data-speed="{$bats_speed|intval}"></script>
