
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<<<<<<< HEAD


if (!("Notification" in window)) {
    console.log("Votre navigateur ne supporte pas les notifications !");
=======
var sound = new Audio("/vue/rsc/sound/notification.mp3");



if (!("Notification" in window)) {
    console.log("This browser does not support desktop notification");
    alert("Votre navigateur commence à sevenir vieux :-( ! \n\n" +
        "Téléchargez en un nouveaux pour profiter de toutes les fonctionnalités !")
>>>>>>> b38080cc35d623f7a6d545c5e4931c51b086ba41
}else{
    Notification.requestPermission();
}

var notify = function(date, user){
    if(!document.hasFocus()){
        if (Notification.permission === "granted") {
            new Notification(
                date + " - " +
                "Nouveau message de " +
                user
            );
        }
        sound.play();         
        
    }
}

var getMessage = function(id_canal,from){
    $.ajax({
        type: "POST",
        url: "/controller/message/get.php",
        data: "id_canal="+id_canal+"&lastMessage="+from,
        success: function(html, textStatus, xhr){
            if(xhr.status == 200){
                $("input[name=lastMessage]").remove();
                $("div#messages").append(html);   
                $("img#success").parent().remove();
                
                notify($("div#message").last().children("a#date").html(),
                $("div#message").last().children("span#transmitter").html();
                
                $("div#message").last().hide().fadeIn(1000);
                
                var top = $("div#message").last().position().top;
                $(window).scrollTop( top ); 
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


