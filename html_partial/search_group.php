</section>
<?php
$memory=[];
$general_memory=[];
foreach ($groups as $group){
    $tampon = $who;
    while(strlen($who)){
        $name = strtolower($group["name"]);
        $group_id =$group["group_id"];
        array_push($general_memory,$group_id);
        if (strlen($who) > 0){
            if(in_array($group_id,$memory) == false){
            array_push($memory,$group_id);?>
            <form id="goToProfile" action="/profile" method="post">
            <input type="hidden" name="profil_id" value="<?= $group["group_id"] ?>" />
                <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
                </button>
                <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                    <?= $group["name"]?>     
                </button>
            </form>
            <?php 
            $who = $tampon;
            break;
        }
        $who=substr($who,0,-1);
        }
    };
}
foreach ($names as $name):
    $group_id = $name["group_id"];
    $group_name = strtolower($name["name"]);
    if (in_array($group_id,$memory) == false){
        ?>
        <form id="goToProfile" action="/profile" method="post">
        <input type="hidden" name="profil_id" value="<?= $name["group_id"] ?>" />
            <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
            </button>
            <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                <?= $name["name"]?>     
            </button>
        </form>
    
    <?php }
        endforeach;?>