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
    $name = $_POST["name"];
    require __DIR__ . "/../function/uuid.php";
    $uuid = guidv4($name);

    $maRequete = $pdo->prepare("INSERT INTO `chats` (`name`, `uuid`) VALUES(:name, :uuid)");
    $maRequete->execute([
        ":name" => $name,
        ":uuid" => $uuid
    ]);

    $maRequete = $pdo->prepare("SELECT `chat_id` FROM `chats` WHERE `uuid` = :uuid ");
    $maRequete->execute([
        ":uuid" => $uuid
    ]);
    $chat_id = $maRequete->fetch();
    $chat_id = $chat_id["chat_id"];
    
    $maRequete = $pdo->prepare("INSERT INTO `chat_members` (`chat_id`, `user_id`) VALUES(:chatId, :userId)");
    $maRequete->execute([
        ":chatId" => $chat_id,
        ":userId" => $user_id
    ]);

    foreach ($_POST as $key => $value) {
        if ($_POST["name"] !== $value) {
            $maRequete = $pdo->prepare("INSERT INTO `chat_members` (`chat_id`, `user_id`) VALUES(:chatId, :userId)");
            $maRequete->execute([
                ":chatId" => $chat_id,
                ":userId" => $value
            ]);
        }
    }
        
    $maRequete = $pdo->prepare("SELECT * FROM `chats` WHERE `chat_id` = :chatId;");
    $maRequete->execute([
        ":chatId" => $chat_id
    ]);
    $chat = $maRequete->fetch();

    $maRequete = $pdo->prepare("SELECT * FROM `chat_members` WHERE `chat_id` = :chatId;");
    $maRequete->execute([
        ":chatId" => $chat_id
    ]);
    $chat_members = $maRequete->fetch();

    $_SESSION["chat"] = $chat;
    $_SESSION["chat_members"] = $chat_members;
    http_response_code(302);
    header('Location: /chat'); //je vais à la page login
    exit();
}
//j'appelle l'html de cette page
require_once __DIR__ . '/../../html_partial/messenger/new_chat.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable