<script type="text/javascript">
/* Blockusreinfo */
	
$(document).ready( function(){
	if( $(window).width() < 991 ){
			 $(".header_user_info").addClass('btn-group');
			 $(".header_user_info .links").addClass('quick-setting dropdown-menu');
		}
		else{
			$(".header_user_info").removeClass('btn-group');
			 $(".header_user_info .links").removeClass('quick-setting dropdown-menu');
		}
	$(window).resize(function() {
		if( $(window).width() < 991 ){
			 $(".header_user_info").addClass('btn-group');
			 $(".header_user_info .links").addClass('quick-setting dropdown-menu');
		}
		else{
			$(".header_user_info").removeClass('btn-group');
			 $(".header_user_info .links").removeClass('quick-setting dropdown-menu');
		}
	});
});
</script>
<!-- Block user information module NAV  -->
<div class="header_user_info pull-left">
	<div data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-cog"></i><span>{l s='Top links' mod='blockuserinfo'} </span></div>	
		<ul class="links">
		{if $is_logged}
			<li>
				<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='View my customer account' mod='blockuserinfo'}" class="account" rel="nofollow">
					<span>{l s='Hello' mod='blockuserinfo'}, {$cookie->customer_firstname} {$cookie->customer_lastname}</span></a>
			</li>
			<li><a class="logout" href="{$link->getPageLink('index', true, NULL, "mylogout")|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Log me out' mod='blockuserinfo'}">
				{l s='Sign out' mod='blockuserinfo'}
			</a></li>
			<li>
				<a href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" title="{l s='My account' mod='blockuserinfo'}">{l s='My Account' mod='blockuserinfo'}</a>
			</li>
		{else}
			<li><a class="login" href="{$link->getPageLink('my-account', true)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Login to your customer account' mod='blockuserinfo'}">
				{l s='Sign in' mod='blockuserinfo'}
			</a></li>
		{/if}

		
		<li class="last"><a href="{$link->getPageLink($order_process, true)|escape:'html':'UTF-8'}" title="{l s='Checkout' mod='blockuserinfo'}" class="last">{l s='Checkout' mod='blockuserinfo'}</a></li>
		 
		<li>
			<a href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}" rel="nofollow">
				{l s='Compare' mod='blockuserinfo'}
			</a>
		</li>
		 
		<li>
			<a href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}" rel="nofollow">
				{l s='delivery' mod='blockuserinfo'}
			</a>
		</li>
		<li>
			<a href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}" rel="nofollow">
				{l s='shipself' mod='blockuserinfo'}
			</a>
		</li>		
		<li>
			<a href="{$link->getPageLink('products-comparison')|escape:'html':'UTF-8'}" title="{l s='Compare' mod='blockuserinfo'}" rel="nofollow">
				{l s='garanty' mod='blockuserinfo'}
			</a>
		</li>		
		</ul>
	
</div>	