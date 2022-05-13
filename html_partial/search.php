<?php
$memory=[];
$end_search=[];
foreach ($profiles as $profile){
    $tampon_first = $who_first_name;
    $tampon_last = $who_last_name;
    while(strlen($who_first_name) > 0 || strlen($who_last_name)>0){
        $first_name = strtolower($profile["first_name"]);
        $last_name = strtolower($profile["last_name"]);
        $user_id =$profile["user_id"];
        if (strlen($who_first_name) > 0){
            if(in_array($user_id,$memory) == false){
            array_push($memory,$user_id);?>
            <form id="goToProfile" action="/profile" method="post">
            <input type="hidden" name="profil_id" value="<?= $profile["user_id"] ?>" />
                <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                    <?= $first_name . " " . $last_name?> 
                    
                </button>
            </form>
            <?php }
         $who_first_name=substr($who_first_name,0,-1);
    }
        if(strlen($who_last_name)>0){
            if(in_array($user_id,$memory) == false){
                array_push($memory,$user_id);?>
            <form id="goToProfile" action="/profile" method="post">
            <input type="hidden" name="profil_id" value="<?= $profile["user_id"] ?>" />
                <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                    <?= $first_name . " " . $last_name?> 
                    
                </button>
            </form>
        
        <?php 
            }
            $who_last_name=substr($who_last_name,0,-1);
        }

    };
    $who_first_name = $tampon_first;
    $who_last_name = $tampon_last;
}