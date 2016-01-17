/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var getOnlineList = function(){
    $.ajax({
        type: "GET",
        url: "/vue/rsc/user/online_list.php",
        success: function(html){
            $("section#listUser").html($(html).children("section#listUser").html());
        },
        dataType: "html"
    });
}

$(document).ready(function(){
    getOnlineList();
});