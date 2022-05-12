<?php if(isset($_SESSION)["user"]['user_id']) && $_SESSION["user"]['theme'] === 1){?>
        <link rel="stylesheet" type="text/css" href="style/style.css?<?php echo time();?>">'
        <link rel="stylesheet" type="text/css" href="style/darkmode.css?<?php echo time();?>">'
    <?php } else { ?>
        <link rel="stylesheet" type="text/css" href="style/style.css?<?php echo time();?>">'
        <link rel="stylesheet" type="text/css" href="style/lightmode.css?<?php echo time();?>">'
    <?php } ?>