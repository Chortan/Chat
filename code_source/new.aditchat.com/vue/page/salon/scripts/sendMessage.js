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
    var date = new Date($.now());
    newMessage.children("img#success").remove();
    newMessage = $("<div id='message' class='me'><a id='date'>"+ date.getHours()+":"+date.getMinutes()+"</a>" + pseudo + " : " + message + "</div>");
    $("div#messages").append(newMessage);
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