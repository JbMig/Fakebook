<?php 
foreach ($profiles as $profile):
    $first_name = $profile["first_name"];
    $last_name = $profile["last_name"];

 ?>
<form id="goToProfile" action="/profile" method="post">
    <button type="submit" id="first_name" style="background: white; border:0; padding:0;"> 
        <?= $first_name . " " . $last_name ?> 
    </button>
</form>
<?php endforeach;?>