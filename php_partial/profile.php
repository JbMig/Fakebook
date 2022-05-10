<?php
ob_start();
// j'ai juste créé le fichier, pour l'instant.




require_once __DIR__ . "/../html_partial/profile.php";
$content = ob_get_clean();
?>