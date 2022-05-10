<?php if($uri === "/entrer.php") :?>
    <!-- script here -->
<?php elseif($uri === "/login") :?>
    <!-- script here -->
<?php elseif($uri === "/timeline") :?>
    <script src="script/timeline_script.js?<?php echo time(); ?>"></script>
<?php elseif($uri === "/profile") :?>
    <script src="script/profile_script.js?<?php echo time(); ?>"></script>
<?php endif; ?>