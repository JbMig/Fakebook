<?php
ob_start();

require_once __DIR__ . "/../database/pdo.php";  // accessing the database


if($_SERVER["REQUEST_METHOD"] === "GET") {
	$profile_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.
	$profile = $_SESSION["user"];
}


if($_SERVER["REQUEST_METHOD"] === "POST") {
	$profile_id = filter_input(INPUT_POST, "profil_id");

    $maRequete = $pdo->prepare("SELECT `user_id`, `email`, `password`, `first_name`, `last_name`, `profil_picture`, `banner`, `status` FROM `users` WHERE `user_id` = :profile_id;");
        $maRequete->execute([
            ":profile_id" => $profile_id
        ]);
	$profile = $maRequete->fetch();
}

require_once __DIR__ . "/../html_partial/profile_settings.php";
$content = ob_get_clean();
?>