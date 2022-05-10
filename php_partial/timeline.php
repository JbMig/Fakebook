<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";
$_SESSION["users"]["user_id"] = 1;

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>