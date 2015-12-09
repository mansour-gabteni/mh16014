
<p>
<span class="availability_date_label"><strong>{l s='delivery' mod='egmultishop'}</strong></span>
<span class="availability_value2" id="delivery_con"></span>
</p>

<script type="text/javascript">
$(document).ready(function(){
	updateDelivery();
	$(document).on('change', '.attribute_select', function(e){
		updateDelivery();
	});	
});

function updateDelivery(){
	var free_price = {$free_price};
	var delivery_price = {$delivery_price};
	if (Math.floor(priceWithDiscountsDisplay) >= free_price )
		$('#delivery_con').text('{l s='free' mod='egmultishop'}');
	else
		$('#delivery_con').text(formatCurrency(delivery_price, currencyFormat, currencySign, currencyBlank));
}
</script>