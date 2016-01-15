/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var getMessage = function(id_canal,from){
    $.ajax({
        type: "POST",
        url: "/controller/message/get.php",
        data: "id_canal="+id_canal,
        success: function(html){
            $("div#messages").append(html);
        },
        dataType: "html"
    });
}  

$(document).ready(function(){
   getMessage(
        $("input[name=id_canal]").val(),
        $("input[name=lastMessage]").val());
    
});
