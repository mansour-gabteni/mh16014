<div style="width: 450px"><h3>{l s='touch city' mod='egmultishop'}</h3>
<select style="width:250px;" id="city_list" name="city_list">
	<option value="0"></option>
{foreach from=$citys item=city}
	<option value="{$city.domain}{$current_page}">{$city.city_name}</option>
{/foreach}
</select>
<button class="btn btn-outline button button-medium exclusive" type="submit" id="touch_city" name="touch_city">
							<span>
								{l s='touch' mod='egmultishop'}
							</span>
</button>
</div>
<div style="margin-top:10px; padding-top:20px; border-top:solid 1px grey;">
<div style="margin-left:20px;"  class="clearfix pull-left">	
	<ul style="list-style-type: circle">	
{$i=0}				
{foreach from=$citys item=city}
	{$i=$i+1}
	{if ($host==$city.domain)}
	<li><b>{$city.city_name}</b></li>
	{else}
	<li><a href="http://{$city.domain}{$current_page}" rel="nofollow">{$city.city_name}</a></li>
	{/if}
	{if ($i%15==0)}
	</ul>
	</div>
	<div style="margin-left:20px;"  class="clearfix pull-left">	
	<ul style="list-style-type: circle">
	{/if}	
{/foreach}
</ul>
</div>

</div>
