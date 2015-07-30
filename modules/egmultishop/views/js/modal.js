
$(document).ready(function() { 
	
	$(document).on('click', '.city-view:visible, .city-view-mobile:visible', function(e){
		e.preventDefault();
		var url = this.rel;
		var anchor = '';

		if (url.indexOf('#') != -1)
		{
			anchor = url.substring(url.indexOf('#'), url.length);
			url = url.substring(0, url.indexOf('#'));
		}

		if (url.indexOf('?') != -1)
			url += '&';
		else
			url += '?';
		
			if (!!$.prototype.fancybox)
				$.fancybox({
					'padding':  20,
					'type':     'ajax',
					'href':     url + 'content_only=1' + anchor
				});	
	});	
	
	$(document).on('click', '#touch_city', function(e){

		var sval = $("#city_list" ).val();
		
		if (sval!=0)
			location.href = "http://" + sval; 
	
	});		
});