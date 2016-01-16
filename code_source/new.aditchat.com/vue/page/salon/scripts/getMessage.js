/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var getMessage = function(id_canal,from){
    $.ajax({
        type: "POST",
        url: "/controller/message/get.php",
        data: "id_canal="+id_canal+"&lastMessage="+from,
        success: function(html){
            $("div#messages").append(html);
            $("input[name=lastMessage]").val($.now());
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


