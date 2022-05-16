<?php
require_once "../database/pdo.php";
// get the comment by article
$maRequete = $pdo->prepare("SELECT * FROM `comments` WHERE `article_id` = :articleId ORDER BY `date`"); // add condition for relationship
    $maRequete->execute([
        ":articleId" => $article["article_id"]
    ]);
    $comments = $maRequete->fetchAll(PDO::FETCH_ASSOC);
//WHERE `status` = 'active'
$maRequete = $pdo->prepare("SELECT `user_id`, `profil_picture`, `first_name`, `last_name` FROM `users` "); // add condition for relationship
    $maRequete->execute();
    $comment_profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);
//
$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $comment_user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $comment_like = "like";

require __DIR__ . "/../html_partial/new_page.php";