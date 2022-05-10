<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
// je vais chercher tous les tweets
$maRequete = $pdo->prepare("SELECT * FROM `articles` ORDER BY `date` DESC"); // add condition for relationship
    $maRequete->execute();
    $articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// // je vais chercher tous les like de l'utilisateur
// $maRequete = $pdo->prepare("SELECT * FROM `` WHERE `user_id` = :userId");
//     $maRequete->execute([
//         ":userId" => $user_id
//     ]);
//     $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
//     $tweet_like_src = "img/unlike.png";

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>