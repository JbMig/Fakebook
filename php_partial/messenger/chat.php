<?php

// start buffering
ob_start();
$title = "Fakebook - Fakenger";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];

$maRequete = $pdo->prepare("SELECT * FROM `messages` WHERE `chat_id` = :chatId ORDER BY `date` DESC");
$maRequete->execute([
    ":chatId" => $user_id
]);
$messages = $maRequete->fetchAll(PDO::FETCH_ASSOC);


require_once __DIR__ . "/../../html_partial/messenger/conversation.php";
// clean buffering in $content
$content = ob_get_clean();

?>