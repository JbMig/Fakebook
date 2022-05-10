<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "login";

// si on est en method POST, on reçoit les donnée du formulaire
//permet de verifier l'utilisateur dans la base de donnée pour créer un connexion
if ("POST" === $_SERVER["REQUEST_METHOD"]) {
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
    $mail = filter_input(INPUT_POST, "mail"); //récupère le mail du formulaire
    //récupère le mdp du formulaire
    $mdp = hash("sha512", filter_input(INPUT_POST, "mdp")); 
    //requete sql pour trouver dans la database l'utilisateur voulu
    $maRequete = $pdo->prepare("SELECT `id`, `mail`, `mdp` FROM `user` WHERE `mail` = :mail;");
    $maRequete->execute([
        ":mail" => $mail
    ]);
    //récupère le résultat de la requète
    $user = $maRequete->fetch();
    //si aucun résultat ou si le mot de passe est invalide
    if (!$user || $user["mdp"] !== $mdp) {
        $message = "Utilisateur invalide";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alerts/baniere.php";
    } else { //sinon j'ajoute le resultat de la requete dans la session
        $_SESSION["user"] = $user;
        header("Location: /projet"); //je vais à la page projet
        exit();
    }
}
//j'appelle l'html de cette page
require_once __DIR__ . "/../html_partial/login.php"; 

$content = ob_get_clean(); //je stock le tampon dans cette variable