/**
 * 
 */
$(document).ready(function() { 
	
	loadCallme();
	window.setTimeout('special()',10000);
	
	$("#callmeform").submit(function() { return false; });
	$(document).on('click', '#callmebtn, #uptocall-mini', function(e){
		metrikaReach('callback');
		e.preventDefault();
		var url = this.rel+"?ajax";

		if (!!$.prototype.fancybox)
				$.fancybox({
					'padding':  20,
					'type':     'ajax',
					'href':     url
				});	

	});	
	
	$(document).on('click', '#submitspecial', function(e){
		e.preventDefault();
		var ocontact;
		ocontact = $("#ocontact").val();

		if (ocontact==""||ocontact.length<5)
			{
				alert("Заполните поле!");
			}
		else{

			$("#submitspecial").prop( "disabled", true );
	    
		    $.ajax({
		         type: 'POST',
		         url: $("#urlaction").val(),
		         data: $("#specialform").serialize(),
		         success: function(data) {
		        	 $("#specialform").fadeOut("fast", function(){
		        		 $("#specialmess").html(data);
		        		 setTimeout("$.fancybox.close()", 1500);
		        	 });
		         }
		    });	
		}
	});	
	
	$(document).on('click', '#submitcallme', function(e){
		e.preventDefault();
		var phone;
		phone = $("#phone").val();

		if (phone==""||phone.length<18)
			{
				alert("Укажите номер телефона!");
			}
		else{

			$("#submitcallme").prop( "disabled", true );
	    
		    $.ajax({
		         type: 'POST',
		         url: $("#urlaction").val(),
		         data: $("#callmeform").serialize(),
		         success: function(data) {
		        	 $("#callmeform").fadeOut("fast", function(){
		        		 $("#callmemess").html(data);
		        		 setTimeout("$.fancybox.close()", 1500);
		        	 });
		         }
		    });	
		}
	});	
	
	$(document).on('click', '#oorder', function(e){
		e.preventDefault();
		var phone;
		var product;
		phone = $("#ophone").val();
		pname = $("#oname").val();
		product = $('h1[itemprop="name"]').text()+" "+$("#group_1 option:selected").text()+" "+$("#our_price_display").text();
		
		if (pname==""||phone.length<3)
		{
			alert("Укажите Ваше имя!");
			return false;
		}
		
		if (phone==""||phone.length<18)
		{
			alert("Укажите номер телефона!");
			return false;
		}

			//$("#oorder").prop( "disabled", true );

		$("#oprod").val(product);
		
		    $.ajax({
		         type: 'POST',
		         url: $("#ourlaction").val(),
		         data: $("#buy_block").serialize(),
		         success: function(data) {
		        	 $("#wdata").html(data);
		         }
		    });	
		
	});		
});


function loadCallme()
{
	
}


function metrikaReach(goal_name) {
	for (var i in window) {
		if (/^yaCounter\d+/.test(i)) {
			window[i].reachGoal(goal_name);
		}
	}
}
/*
if(data == "true") {
	               $("#callmeform").fadeOut("fast", function(){
	                  setTimeout("$.fancybox.close()", 1000);
	               });
	            }
*/