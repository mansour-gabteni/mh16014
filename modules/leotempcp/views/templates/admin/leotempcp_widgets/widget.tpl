{*
 *  Leo Theme for Prestashop 1.6.x
 *
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
*}
{if $widget_selected}
	{$form}
	 <script type="text/javascript">
		$('#widget_type').change( function(){
			location.href = '{html_entity_decode($action)}&wtype='+$(this).val();
		} );
	</script>	
 {else}
 <div class="col-lg-12" style="padding:20px;">
		 {if $is_using_managewidget}
		<div class="col-lg-5">
		<h3>{l s='Only for Module leomanagewidgets' mod='leotempcp'}</h3> 
			{foreach $types as $widget => $text}
				{if $text.for == 'manage'}
					<div class="col-lg-6">
						<h4><a href="{html_entity_decode($action)}&wtype={$widget}">{$text.label}</a></h4>
						<p><i>{$text.explain}</i></p>	
					</div>
				{/if}	
			{/foreach} 
		</div>
		{/if}
		<div class="col-lg-6 col-lg-offset-1">
		<h3>{l s='For all module (leomanagewidget,leomenubootstrap, leomenusidebar)' mod='leotempcp'}</h3> 
			{foreach $types as $widget => $text}
				{if $text.for != 'manage'}
					<div class="col-lg-6">
						<h4><a href="{html_entity_decode($action)}&wtype={$widget}">{$text.label}</a></h4>
						<p><i>{$text.explain}</i></p>	
					</div>
				{/if}	
			{/foreach} 
		</div>
</div>		
{/if}
