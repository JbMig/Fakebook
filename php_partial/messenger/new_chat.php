<?php

//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "Fakebook - New chat";
require_once __DIR__ . "/../../database/pdo.php"; //je récupère le PDO
$user_id = $_SESSION["user"]["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $maRequete = $pdo->prepare("SELECT user_id_a, user_id_b FROM `relationships` WHERE (`user_id_a` = :userId OR `user_id_b` = :userId) AND (`status` = 'approved') AND (`blocked` = 'no' ) ");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $friend_ids = $maRequete->fetchAll();
    $friend_profils = [];
    foreach ($friend_ids as $friend_id) {
        if ($friend_id["user_id_a"] !== $user_id) {
            $maRequete = $pdo->prepare("SELECT `first_name`, `last_name`, `profil_picture` , `user_id` FROM `users` WHERE `user_id` = :userId ");
            $maRequete->execute([
                ":userId" => $friend_id["user_id_a"]
            ]);
            $get_profil = $maRequete->fetch();
            array_push($friend_profils, $get_profil);
        } else {
            $maRequete = $pdo->prepare("SELECT `first_name`, `last_name`, `user_id` FROM `users` WHERE `user_id` = :userId");
            $maRequete->execute([
                ":userId" => $friend_id["user_id_b"]
            ]);
            $get_profil = $maRequete->fetch();
            array_push($friend_profils, $get_profil);
        }
    }    
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = filter_input(INPUT_POST, "name");

    $maRequete = $pdo->prepare("INSERT INTO `chats` (`name`) VALUES(:name)");
    $maRequete->execute([
        ":name" => $name
    ]);
        
    $maRequete = $pdo->prepare("SELECT * FROM `chats` WHERE `name` = :name;");
    $maRequete->execute([
        ":name" => $name
    ]);
    $chat = $maRequete->fetch();

    $_SESSION["chat"] = $chat;
    http_response_code(302);
    header('Location: /conversation'); //je vais à la page login
    exit();
}
//j'appelle l'html de cette page
require_once __DIR__ . '/../../html_partial/messenger/new_chat.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable