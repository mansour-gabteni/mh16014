<style>
.spanel {
    clear: both;
    float: left;
    width: 100%;
    background: #13b884;
}
.sizepanel{
	clear: both;
    float: left;
    width: 100%;
}
.searceform{
	padding:18px;
}
.searhetitle{
	font-size: 14pt;
    color: white;
    font-weight: bold;
}
.searchelabe{
	font-size: 12pt;
    color: white;
    font-weight: bold;
    padding-top:5px;	
}
.srow{
	padding-top:10px;
	}
.grhead, .grlabel{
    color: black;
    font-weight: bold;
    padding-top:15px;
}
.grhead{
	font-size: 14pt;
	color:#e85222;
}
.grlabel{
	font-size: 11pt;
}
.syr{
	padding:4px 0px 2px 0px;
}

.swh{
	background-color:white;
	margin:2px;
	padding:2px;
}

</style>
<script>
//onClick="form1.action='/3-matrasy#/'+$('#ssize' ).val();form1.submit();"
</script>
<div class="row" style="padding:5px; background: #F9F9F9;">
  <div class="col-md-3">
	<div class="spanel">
	<form action="" class="searceform" name="form1">
	<div class="searhetitle">{l s='podbor' mod='egsearche'}:</div>
	<div class="srow"><span class="searchelabe">{l s='size' mod='egsearche'}</span> 
	<select class="select form-control" id="ssize">
		<option value="">{l s='umsize' mod='egsearche'}</option>
		<option value="matrassize-70_186">70x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-70_190">70x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-70_195">70x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-70_200">70x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-80_186">80x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-80_190">80x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-80_195">80x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-80_200">80x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-90_186">90x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-90_190">90x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-90_195">90x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-90_200">90x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-100_186">100x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-100_190">100x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-100_195">100x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-100_200">100x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-120_186">120x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-120_190">120x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-120_195">120x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-120_200">120x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-140_186">140x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-140_190">140x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-140_195">140x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-140_200">140x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-160_186">160x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-160_190">160x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-160_195">160x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-160_200">160x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-180_186">180x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-180_190">180x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-180_195">180x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-180_200">180x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-200_186">200x186 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-200_190">200x190 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-200_195">200x195 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-200_200">200x200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-200">Ø 200 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-210">Ø 210 {l s='sm' mod='egsearche'}</option>
		<option value="matrassize-220">Ø 220 {l s='sm' mod='egsearche'}</option>

	</select>
	</div>
	<div class="srow"><span class="searchelabe">{l s='type' mod='egsearche'}</span> 
	<select class="select form-control" id="mtype">
		<option value="">{l s='all' mod='egsearche'}</option>
		<option value="tip_matrasa-bespruzhinnyj">{l s='bespr' mod='egsearche'}</option>
		<option value="tip_matrasa-zavisimye_pruzhiny-nezavisimye_pruzhiny">{l s='pruzh' mod='egsearche'}</option>
	</select>
	</div>
	<div class="srow"><span class="searchelabe">{l s='zhesk' mod='egsearche'}</span> 
	<select class="select form-control" id="zhesk">
		<option value="">{l s='any' mod='egsearche'}</option>
		<option value="87_1">{l s='nizk' mod='egsearche'}</option>
		<option value="87_1">{l s='sred' mod='egsearche'}</option>
		<option value="87_1">{l s='visok' mod='egsearche'}</option>
	</select>
	</div>
	<div class="srow">		
		<p class="buttons_bottom_block no-print">
			<button type="submit" name="Submit" onClick="form1.action='/3-matrasy#/'+$('#ssize' ).val()+'/'+$('#mtype' ).val();form1.submit();" class="exclusive btn btn-default searchelabe" style="width: 100%;background-color: #219E77;"> <span>{l s='searche' mod='egsearche'}</span> </button></p>
	</div>	
	</form>
	</div>
  </div>
  <div class="col-md-9"><div class="sizepanel">
  	<div class="row text-center">
  		<div class="col-md-12 syr"><span class="grhead">{l s='sizes' mod='egsearche'}</span></div>
  	</div>
  	<div class="row text-center">
 
  		<div class="col-md-3 syr">
  			<div class="row">
  				<div class="col-xs-12 syr text-center"><span class="grlabel">{l s='single' mod='egsearche'}</span></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-70_186">70x186</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-90_186">90x186</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-70_190">70x190</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-90_190">90x190</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-70_195">70x195</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-90_195">90x195</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-70_200">70x200</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-90_200">90x200</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-80_186">80x186</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-120_186">120x186</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-80_190">80x190</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-120_190">120x190</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-80_195">80x195</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-120_195">120x195</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-80_200">80x200</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-120_200">120x200</a></div>
  			</div>   			  			
  		</div>
  		
  		<div class="col-md-3 syr">
  			<div class="row">
  				<div class="col-xs-12 syr text-center"><span class="grlabel">{l s='double' mod='egsearche'}</span></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-140_186">140x186</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-180_186">180x186</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-140_190">140x190</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-180_190">180x190</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-140_195">140x195</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-180_195">180x195</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-140_200">140x200</a></div> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-180_200">180x200</a></div>
  			</div>  	
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-160_186">160x186</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-200_186">200x186</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-160_190">160x190</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-200_190">200x190</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-160_195">160x195</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-200_195">200x195</a></div>
  			</div>
  			<div class="row swh"> 
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-160_200">160x200</a></div>
  				<div class="col-xs-6 syr"><a href="http://{$host}/3-matrasy#/matrassize-200_200">200x200</a></div>
  			</div>    					  			
  		</div>
  		<div class="col-md-6 syr">
  			<div class="row">
  				<div class="col-xs-12 syr text-center"><span class="grlabel">{l s='kids' mod='egsearche'}</span></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_120">60x120</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_120">70x120</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_120">80x120</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_120">90x120</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_130">60x130</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_130">70x130</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_130">80x130</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_130">90x130</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_140">60x140</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_140">70x140</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_140">80x140</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_140">90x140</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_150">60x150</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_150">70x150</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_150">80x150</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_150">90x150</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_160">60x160</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_160">70x160</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_160">80x160</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_160">90x160</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_170">60x170</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_170">70x170</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_170">80x170</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_170">90x170</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_180">60x180</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_180">70x180</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_180">80x180</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_180">90x180</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_190">60x190</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_190">70x190</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_190">80x190</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_190">90x190</a></div>
  			</div>
  			<div class="row swh">
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-60_200">60x200</a></div> 
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-70_200">70x200</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-80_200">80x200</a></div>
  				<div class="col-xs-3 syr"><a href="http://{$host}/5-detskie-matrasy#/matrassize-90_200">90x200</a></div>
  			</div>  			  			  			
  		</div>
  	 		
  	</div>
  	</div></div>
</div>