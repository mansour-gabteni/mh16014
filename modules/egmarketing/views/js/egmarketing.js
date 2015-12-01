/**
 * 
 */
$(document).ready(function() { 
	
	//loadCallme();
	//window.setTimeout('special()',10000);
	
/*	
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
		         url: egmarketing_ajaxcontroller,
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
	*/
	
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

		$("#oprod").val(product);
		    $.ajax({
		         type: 'POST',
		         url: egmarketing_ajaxcontroller,
		         data: $("#buy_block").serialize(),
		         success: function(data) {
		        	 $("#wdata").html(data);
		         }
		    });	
		
	});		
});




function metrikaReach(goal_name) {
	for (var i in window) {
		if (/^yaCounter\d+/.test(i)) {
			window[i].reachGoal(goal_name);
		}
	}
}
