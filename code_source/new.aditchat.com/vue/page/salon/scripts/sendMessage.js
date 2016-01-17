var newMessage = $("");
var pseudo = $("div#pseudo a").html();

var sendMessage = function(id_canal,message){
    $.ajax({
        type: "POST",
        url: "/controller/message/send.php",
        data: "id_canal="+id_canal+"&message="+message,
        success: function(html){
           newMessage.append("<img id='success' src='/vue/rsc/image/emoji/16x16/2714.png'/>");
        },
        dataType: "html"
    });
}

var addMessageToList = function(message){
    var date = new Date($.now()),
        hours, 
        minutes;
    
    if(date.getHours()<10){
        hours = "0" + date.getHours();
    }else{
        hours = "" + date.getHours();
    }
    
    if(date.getMinutes()<10){
        minutes = "0" + date.getMinutes();
    }else{
        minutes = "" + date.getMinutes();
    }
    
    newMessage = $("<div id='message' class='me'><a id='date'>"+ date.getHours()+":"+date.getMinutes()+"</a>" + pseudo + " : " + message + "</div>");
    $("div#messages").append(newMessage);
    newMessage.hide().fadeIn(1000);
}

$(document).ready(function(){    
    $("form#messageSender").submit(function(event) {
        event.preventDefault();
        message = $("input#message[type=text]").val();
        $("input#message[type=text]").val("");
        addMessageToList(message);  
        sendMessage($("input[name=id_canal]").val(),message);
    });
});