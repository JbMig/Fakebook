<?php

// start buffering
ob_start();
$title = "Fakebook - Fakenger";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];

$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];

// get every conversation
$maRequete = $pdo->prepare("SELECT * FROM `chats` ORDER BY `date` DESC"); // add condition for relationship
    $maRequete->execute();
    $conversations = $maRequete->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . "/../../html_partial/messenger/conversation.php";
// clean buffering in $content
$content = ob_get_clean();

?>