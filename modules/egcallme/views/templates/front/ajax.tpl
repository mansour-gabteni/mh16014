{if $view=="form"}
<div id="callmemess"></div>
<form id="callmeform" name="callmeform" action="#" method="post">
<fieldset>
	<h3>{l s='order call back' mod='egcallme'}</h3>
	<div class="clearfix">
		<label for="phone">{l s='phone' mod='egcallme'}</label>
			<input class="form-control grey validate" type="text" id="phone" name="phone" data-validate="isEmail" value="">
	</div>
	<input type="hidden" id="ajax" name="ajax" value="">
	<input type="hidden" id="action" name="action" value="new">
	<input type="hidden" id="urlaction" name="urlaction" value="{$ajaxcontroller}">
	<label for="message">{l s='message' mod='egcallme'}</label>
    	<textarea class="form-control" id="message" name="message"></textarea>
	</div>
	<div class="submit">
		<button type="submit" name="submitcallme" id="submitcallme" class="button btn btn-outline button-medium"><span>{l s='call me' mod='egcallme'}</span></button>
	</div>
</fieldset>
</form>
{else}
<span>{l s='submited' mod='egcallme'}</span>
{/if}