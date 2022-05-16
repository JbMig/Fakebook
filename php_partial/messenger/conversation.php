<?php

// start buffering
ob_start();
$title = "Fakebook - Fakenger";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];

$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];

// get every conversation
$maRequete = $pdo->prepare("SELECT * FROM `chats` WHERE `chat_id` IN (SELECT `chat_id` FROM `chat_members` WHERE `user_id` = :userId );");
$maRequete->execute([
    ":userId" => $user_id
]);
$conversations = $maRequete->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $chat_id = filter_input(INPUT_POST, "chat_id");

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

require_once __DIR__ . "/../../html_partial/messenger/conversation.php";
// clean buffering in $content
$content = ob_get_clean();

?>