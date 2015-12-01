
{if $view=="mess"}
<span>{l s='submited' mod='egmarketing'}</span>
{/if}
{if $view=="thanks"}
<div>{l s='thanks' mod='egmarketing'}</div>
<div>{l s='whill meet you' mod='egmarketing'}</div>
{/if}

{if $view=="specialsand"}
<div>{l s='special sand' mod='egmarketing'}</div>
{/if}

{if $view=="specialmodal"}
<div id="specialmess"></div>
<form id="specialform" name="specialform" action="#" method="post">
<img src="http://{$host}/s.jpg">
<fieldset>
	<div class="clearfix">
		<label for="ocontact">{l s='get by email' mod='egmarketing'}</label> <!-- {l s='get by phone' mod='egmarketing'} -->
			<input class="form-control grey validate" type="" placeholder="" id="ocontact" name="ocontact" maxlength="32"  required="">
	</div>
	<input type="hidden" id="ajax" name="ajax" value="">
	<input type="hidden" id="action" name="action" value="apecialadd">
	<input type="hidden" id="urlaction" name="urlaction" value="{$ajaxcontroller}">
	<div class="submit">
		<button type="submit" name="submitspecial" id="submitspecial" class="button btn btn-outline button-medium"><span>{l s='get coupon' mod='egmarketing'}</span></button>
	</div>
</fieldset>
</form>
{/if}