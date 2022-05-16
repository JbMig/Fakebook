<section>
	<form id="deco_form" method="post" action="/sign_out">
		<button class="nav_deco" id="deconnection" type="submit">Deconnection</button>
		<input type="hidden" name="deco">
	</form>
	<a href="timeline">Fil d'actualité</a>
	<form id="search" method="post" action="/search">
	    <label id="search" for="search"></label>
        <input id="search" type="text" name="search">
        <button id="search" type="submit">Chercher</button>
</form>
</section>
<?php
$memory=[];
$general_memory=[];
foreach ($profiles as $profile){
    $tampon_first = $who_first_name;
    $tampon_last = $who_last_name;
    while(strlen($who_first_name) > 0 || strlen($who_last_name)>0){
        $first_name = strtolower($profile["first_name"]);
        $last_name = strtolower($profile["last_name"]);
        $user_id =$profile["user_id"];
        array_push($general_memory,$user_id);
        if (strlen($who_first_name) > 0){
            if(in_array($user_id,$memory) == false){
            array_push($memory,$user_id);?>
            <form id="goToProfile" action="/profile" method="post">
            <input type="hidden" name="profil_id" value="<?= $profile["user_id"] ?>" />
                <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
                    <img src="img_profil/<?=  $_SESSION["user"]["profil_picture"] ?>" alt="" width="40px">
                </button>
                <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                    <?= $first_name . " " . $last_name?>     
                </button>
            </form>
            <?php 
            $who_first_name = $tampon_first;
            $who_last_name = $tampon_last;
            break;
        }
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
                $who_first_name = $tampon_first;
                $who_last_name = $tampon_last;
                break; 
            }
            $who_last_name=substr($who_last_name,0,-1);
        }
    };
    $who_first_name = $tampon_first;
    $who_last_name = $tampon_last;
}
foreach ($names as $name):
    $user_id = $name["user_id"];
    $first_name = strtolower($name["first_name"]);
    $last_name = strtolower($name["last_name"]);
    if (in_array($user_id,$memory) == false){
        ?>
        <form id="goToProfile" action="/profile" method="post">
        <input type="hidden" name="profil_id" value="<?= $name["user_id"] ?>" />
            <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
                <img src="img_profil/<?=  $_SESSION["user"]["profil_picture"] ?>" alt="" width="40px">
            </button>
            <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                <?= $first_name . " " . $last_name?>     
            </button>
        </form>
    
    <?php }
        endforeach;?>