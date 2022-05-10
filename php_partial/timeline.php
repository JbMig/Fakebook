<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'acualité";

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>