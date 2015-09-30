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
	});	
});


function loadCallme()
{
	
}

function checkPhone() {
    var a = l.getElementById('lptrack_phone').value;
    if (a == '') {
        if (O != '') {
            l.getElementById('lptrack_phone').value = O
			} else {
            if (typeof default_phone[B] != "undefined") {
                l.getElementById('lptrack_phone').value = default_phone[B]
				} else {
                l.getElementById('lptrack_phone').value = '+'
			}
		}
	}
    a = l.getElementById('lptrack_phone').value;
    if (a == '+8') {
        l.getElementById('lptrack_phone').value = '+7'
	}
    if (a == '9' || a == '+9') {
        l.getElementById('lptrack_phone').value = '+79'
	}
    if (a == '495' || a == '+495') {
        l.getElementById('lptrack_phone').value = '+7495'
	}
    if (a == '499' || a == '+499') {
        l.getElementById('lptrack_phone').value = '+7499'
	}
    if (a.charAt(0) != '+') {
        l.getElementById('lptrack_phone').value = '+' + a.replace('+', '')
	}
    l.getElementById('lptrack_phone').value = l.getElementById('lptrack_phone').value.replace(/[^\d\+.]/g, "")
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