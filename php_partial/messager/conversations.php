<?php

// start buffering
ob_start();
$title = "Fakebook - Fakenger";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];

$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];

// je vais chercher tous les tweets
$maRequete = $pdo->prepare("SELECT * FROM `chats` ORDER BY `date` DESC"); // add condition for relationship
    $maRequete->execute();
    $articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// looking for the user's friends (will not work here)
$maRequete = $pdo->prepare("SELECT `user_id_a`, `user_id_b`, `status`, `blocked` FROM `relationships` WHERE (`user_id_b` = :userId OR `user_id_a` = :userId) AND `status`='approved';");
	$maRequete->execute([
		":userId" => $_SESSION["user"]["user_id"]
	]);
$profile_friends = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT `user_id`, `status` FROM `users`;");
	$maRequete->execute();
$active_accounts = $maRequete->fetchAll(PDO::FETCH_ASSOC);

//var_dump($profile_friends);
// foreach ($articles as $article) {
// 	var_dump($article["user_id"]);
// }
// foreach ($profiles as $profile) {
//     var_dump($profile["status"]);
// }
require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>