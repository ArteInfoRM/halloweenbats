{*
**
*  2009-2025 Arte e Informatica
*
*  For support feel free to contact us on our website at https://www.arteinformatica.eu
*
*  @author    Arte e Informatica <admin@arteinformatica.eu>
*  @copyright 2009-2025 Arte e Informatica
*  @version   2.1
*  @license   One Paid Licence By WebSite Using This Module. No Rent. No Sell. No Share.
*
*}

{if $hw_jquery == 1}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{/if}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$.fn.halloweenBats({
		image: '{/literal}{$bats_url|escape:'htmlall':'UTF-8'}{literal}', // Path to the image.
		amount: {/literal}{$bats_amount|escape:'htmlall':'UTF-8'}{literal}, // Bat amount.
		speed: {/literal}{$bats_speed|escape:'htmlall':'UTF-8'}{literal}, // Higher value = faster.
	});
});
</script>
{/literal}	

