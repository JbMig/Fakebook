<?php
ob_start();
$title = "profile";
// j'ai juste créé le fichier, pour l'instant.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
}



require_once __DIR__ . "/../html_partial/profile.php";
$content = ob_get_clean();
?>