<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "sign up";

// si on est en method POST, on reçoit les donnée du formulaire
// permet de créer un utilisateur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = filter_input(INPUT_POST, "email"); //récupère le mail du formulaire
    //récupère le mdp du formulaire
    $mdp = hash("sha512", filter_input(INPUT_POST, "password"));
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
    //requete sql pour trouver dans la database l'utilisateur voulu
    $maRequete = $pdo->prepare("SELECT `email` FROM `user_id` WHERE `email` = :email;");
    $maRequete->execute([
        ":email" => $mail
    ]);

    //récupère le résultat de la requète
    $user = $maRequete->fetch();
    if ($user == false) { //si aucun résultat
        //j'ajoute le résultat du formulaire dans la database
        $maRequete = $pdo->prepare("INSERT INTO `user_id` (`email`, `mdp`) VALUES(:email, :mdp)");
        $maRequete->execute([
            ":email" => $mail,
            ":password" => $mdp
        ]);
        http_response_code(302);
        header('Location: /login'); //je vais à la page login
        exit();
    } else { //sinon
        $message = "l'utilisateur existe déjà";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
    }
}
//j'appelle l'html de cette page
require_once __DIR__ . '/../html_partial/sign_up.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable
