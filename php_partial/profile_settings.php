<?php
ob_start();

require_once __DIR__ . "/../database/pdo.php";  // accessing the database

if($_SERVER["REQUEST_METHOD"] === "GET") {

    $user_id = $_SESSION["user"]["user_id"];
    $maRequete = $pdo->prepare("SELECT `theme` FROM `users` WHERE `user_id` = :userId;");
        $maRequete->execute([
            ":userId" => $user_id
        ]);
	$theme = $_SESSION["user"]["theme"];
}

require_once __DIR__ . "/../html_partial/profile_settings.php";
$content = ob_get_clean();
?>