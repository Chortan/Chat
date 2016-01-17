
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Notification.requestPermission();

if (!("Notification" in window)) {
    console.log("This browser does not support desktop notification");
    alert("Votre navigateur commence à sevenir vieux :-( ! \n\n" +
        "Téléchargez en un nouveaux pour profiter de toutes les fonctionnalités !")
}

var getMessage = function(id_canal,from){
    $.ajax({
        type: "POST",
        url: "/controller/message/get.php",
        data: "id_canal="+id_canal+"&lastMessage="+from,
        success: function(html){
            $("input[name=lastMessage]").remove();
            $("div#messages").append(html);   
            $("img#success").parent().remove();
            if (Notification.permission === "granted") {
                new Notification(
                    $("div#message").last().children("a#date").html() + " - " +
                    "Nouveau message de " +
                    $("div#message").last().children("span#transmitter").html()
                );
            }
        },
        dataType: "html"
    });
}

var timer = function(){
    getMessage(
        $("input[name=id_canal]").val(),
        $("input[name=lastMessage]").val());
        setTimeout(timer, 2000);
}

$(document).ready(function(){
    timer();
});


