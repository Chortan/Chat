$(document).ready(function(){
	
	var userName = $("input[type=hidden]#userName").val();
	var messageSender=$("div input[type=text].messageSender");

	var sendDataMessage = function(message){
		alert(message);
		$.ajax({
		  type: "POST",
		  url: "/Salon/Canal",
		  data: "message="+message,
		  success: function(html){
		  	alert("Message "+message+" A été délivrer, et la page à retourner : "+html);
		  },
		  dataType: "html"
		});
	}
	
	
	
	alert($("section.displatMessages").height() + " x " + $("section.displatMessages").width());
	var displayMessage = function(){		
		if(messageSender.val().replace(' ','')!=""){
			var message=messageSender.val();
			var myMessage = $("<div class='you'><p><span class='userName'>"+userName+" : </span>"+message+"</p></div>");
			messageSender.val("");
			$("section.displayMessages").append(myMessage);
			setTimeout(function(){
				myMessage.scrollTop();
			},500);
		}
	}
	
	$("div input[type=text].messageSender").keypress(function(e){
		if(e.which==13){
			sendDataMessage(messageSender.val());
			displayMessage();
		}			
	});
	
	$("div.messageSender input[type=button].messageSender").click(function(){
		sendDataMessage(messageSender.val());		
		displayMessage();
	});
	
	
	
});