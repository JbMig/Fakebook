<?php

// start buffering
ob_start();
<<<<<<< HEAD
$title = "Fakebook - fil d'acualité";
=======
$title = "Fakebook - fil d'actualité";
>>>>>>> main

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>