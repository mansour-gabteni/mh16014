/**
 * 
 */
$(document).ready(function() { 
	
	loadCallme();
	
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
		phone = $("#ophone").val();
		pname = $("#oname").val();
		
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