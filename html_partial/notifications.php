<?php
foreach($profiles as $profile):
    foreach($friends as $friend):
        if($friend["status"]== "pending" && $friend["user_id_b"] == $profile["user_id"]){
            $id = $friend["user_id_a"];
?>
        <form id="goToProfile" action="/profile" method="post">
        <input type="hidden" name="profil_id" value="<?= $id ?>" />
            <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
                <img src="img_profil/<?=  $_SESSION["user"]["profil_picture"] ?>" alt="" width="40px">
            </button>
            <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> Nouvelle demande de relation
            </button>
        </form>
        <?php
                        
        }
    endforeach;
endforeach;
    

require_once __DIR__ . "/../php_partial/notifications.php"?>