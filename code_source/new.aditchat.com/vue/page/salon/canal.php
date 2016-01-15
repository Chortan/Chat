<?php
    
    authentificationRequire();	
    
    
    if(isset($_GET["id"]) ){
        if(is_numeric($_GET["id"])){    
            $canal = Canal::getCanalByID($_GET["id"]);
            if($canal){
                if($canal->isInCanal($_SESSION["user"])){
                    echo("<h3>". $canal->getName() ."</h3>");
                }

            }
        }
	
?>
<script src="/vue/page/salon/scripts/getMessage.js"></script>
<div id="messages"><input type="hidden" name="lastMessage" value="0"/></div>

<form action="/controller/message/send.php" method="POST">
    <input type="hidden" name="id_canal" value="<?php echo($_GET["id"]); ?>"/>
    <input type="text" name="message" id="message" class="form-control" placeholder="Message ..."/>
    <input type="submit" id="envoiMessage" class="btn btn-primary"/>
</form>


<?php
    }else{
        include($_SERVER["DOCUMENT_ROOT"]."/vue/rsc/user/online_list.php");
    }
?>