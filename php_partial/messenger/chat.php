<?php

// start buffering
ob_start();
$title = "Fakebook - Fakenger";

// require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
$chat_id = $_SESSION["chat"]["chat_id"];
$members = $_SESSION["chat_members"];

// $maRequete = $pdo->prepare("SELECT * FROM `messages` WHERE `chat_id` = :chatId ORDER BY `date`");
// $maRequete->execute([
//     ":chatId" => $chat_id
// ]);
// $messages = $maRequete->fetchAll(PDO::FETCH_ASSOC);
//echo json_encode($test);

require_once __DIR__ . "/../../html_partial/messenger/chat.php";
// clean buffering in $content
$content = ob_get_clean();

?>