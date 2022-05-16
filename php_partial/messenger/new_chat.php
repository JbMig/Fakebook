<?php

//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "Fakebook - New chat";

// si on est en method POST, on reçoit les donnée du formulaire
// permet de créer un utilisateur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = filter_input(INPUT_POST, "name");
    $user_id = $_session["user"]["user_id"];
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO

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
require_once __DIR__ . '/../../html_partial/new_chat.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable