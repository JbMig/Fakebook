<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];

$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];

// je vais chercher tous les tweets
$maRequete = $pdo->prepare("SELECT * FROM `articles` ORDER BY `date` DESC"); // add condition for relationship
    $maRequete->execute();
    $articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT `user_id`, `profil_picture`, `first_name`, `last_name` FROM `users` WHERE `status` = 'active' "); // add condition for relationship
    $maRequete->execute();
    $profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $like = "like";

// looking for the user's friends (will not work here)
$maRequete = $pdo->prepare("SELECT `user_id_a`, `user_id_b`, `status`, `blocked` FROM `relationships` WHERE (`user_id_b` = :userId OR `user_id_a` = :userId) AND `status`='approved';");
	$maRequete->execute([
		":userId" => $_SESSION["user"]["user_id"]
	]);
$profile_friends = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT `user_id`, `status` FROM `users`;");
	$maRequete->execute();
$active_accounts = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// var_dump($profile_friends);
// foreach ($articles as $article) {
// 	var_dump($article["user_id"]);
// }
require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>