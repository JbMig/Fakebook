<?php
ob_start();

require_once __DIR__ . "/../../database/pdo.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
	$page_id = $_SESSION["page"]["page_id"];
    $name = $_SESSION["page"]["name"];
    $picture = $_SESSION["page"]["picture"];
    $banner = $_SESSION["page"]["banner"];

    $maRequete = $pdo->prepare("SELECT `theme` FROM `users` WHERE `user_id` = :userId;");
        $maRequete->execute([
            ":userId" => $user_id
        ]);
	$theme = $_SESSION["user"]["theme"];
}


require_once __DIR__ . "/../../html_partial/settings_public_page/settings_public_page.php";
$content = ob_get_clean();
