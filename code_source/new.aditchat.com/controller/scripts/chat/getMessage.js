/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var getAllMessage = function(idCanal){
$.post("/controlleur/message/get.php",
    {
        idCanal: idcanal
    },
    function(data, status){
        alert("Data: " + data + "\nStatus: " + status);
    });
}