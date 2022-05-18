</section>
<?php
$memory=[];
$general_memory=[];
foreach ($pages as $page){
    $tampon = $who;
    while(strlen($who)){
        $name = strtolower($page["name"]);
        $page_id =$page["page_id"];
        array_push($general_memory,$page_id);
        if (strlen($who) > 0){
            if(in_array($page_id,$memory) == false){
            array_push($memory,$page_id);?>
            <form id="goToProfile" action="/public_page" method="post">
            <input type="hidden" name="profil_id" value="<?= $page["page_id"] ?>" />
                <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
                </button>
                <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                    <?= $page["name"]?>     
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
    $page_id = $name["page_id"];
    $page_name = strtolower($name["name"]);
    if (in_array($page_id,$memory) == false){
        ?>
        <form id="goToProfile" action="/public_page" method="post">
        <input type="hidden" name="profil_id" value="<?= $name["page_id"] ?>" />
            <button type="submit" id="profil_picture" style="background: white; border:0; padding:5px;">
            </button>
            <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
                <?= $name["name"]?>     
            </button>
        </form>
    
    <?php }
        endforeach;?>