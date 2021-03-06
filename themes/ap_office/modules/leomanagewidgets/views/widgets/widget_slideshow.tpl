{if $slides}	
{assign var="t_image" value="image_`$iso_code`"}
{assign var="t_thumb" value="thum_`$iso_code`"}
{assign var="t_title" value="title_`$iso_code`"}
{assign var="t_description" value="description_`$iso_code`"}

    <!-- main slider carousel -->
    <div class="row">
        <div class="col-md-12" id="slider">
                <div id="carousel-example-generic">
                    <div id="myCarousel" class="carousel slide">
						<ol class="carousel-indicators">
							{foreach $slides as $slide name=item}
							<li data-target="#carousel-example-generic" data-slide-to="{$smarty.foreach.item.index}" {if $smarty.foreach.item.first}class="active"{/if}></li>
							{/foreach}	
						</ol>
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
							{foreach $slides as $slide name=slides}
								<div class="item {if $smarty.foreach.slides.first}active{/if} " data-slide-number="{$smarty.foreach.slides.index}">
									{if  isset($slide[$t_image]) && $slide[$t_image]}
										<img src="{$pathimg}{$slide[$t_image]}" alt="" style="width:{$img_width}px;height:{$img_height}px" class="img-responsive">
									{/if}	
									  <div class="carousel-caption">
										{if  isset($slide[$t_title]) && $slide[$t_title]}<h3>{$slide[$t_title]}</h3>{/if}
										{if  isset($slide[$t_description]) && $slide[$t_description]}<p>{$slide[$t_description]}</p>{/if}		
									  </div>
								</div>
							{/foreach}
                        </div>
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="fa fa-angle-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="fa fa-angle-right"></span>
						</a>
                    </div>
                </div>
				  <!-- Controls -->

        </div>
   
    <!--/main slider carousel-->
</div>

{/if}  
<script type="text/javascript">
{literal}
$('#myCarousel').carousel({
    interval: {/literal}{$interval}{literal}
});

// handles the carousel thumbnails
$('[id^=carousel-selector-]').click( function(){
  var id_selector = $(this).attr("id");
  var id = id_selector.substr(id_selector.length -1);
  id = parseInt(id);
  $('#myCarousel').carousel(id);
  $('[id^=carousel-selector-]').removeClass('selected');
  $(this).addClass('selected');
});

// when the carousel slides, auto update
$('#myCarousel').on('slid', function (e) {
  var id = $('.item.active').data('slide-number');
  id = parseInt(id);
  $('[id^=carousel-selector-]').removeClass('selected');
  $('[id^=carousel-selector-'+id+']').addClass('selected');
});
{/literal}
</script>