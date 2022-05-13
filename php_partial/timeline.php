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

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>