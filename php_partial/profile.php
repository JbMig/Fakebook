<?php
ob_start();
$title = "Fakebook - Profil de ...";

require_once __DIR__ . "/../database/pdo.php"; // accessing the database

$user_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.





require_once __DIR__ . "/../html_partial/profile.php";
$content = ob_get_clean();
?>