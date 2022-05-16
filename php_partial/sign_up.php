<?php
//mise en tampon pour stockage dans une variable
ob_start();
//valeur pour la balisehtml <title>
$title = "sign up";

// si on est en method POST, on reçoit les donnée du formulaire
// permet de créer un utilisateur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = filter_input(INPUT_POST, "firstName");
    $nom = filter_input(INPUT_POST, "lastName");
    $mail = filter_input(INPUT_POST, "email"); //récupère le mail du formulaire
    //récupère le mdp du formulaire
    $mdp = hash("sha512", filter_input(INPUT_POST, "password"));
    $confirmMdp = hash("sha512", filter_input(INPUT_POST, "confirmPassword"));
    require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
    //requete sql pour trouver dans la database l'utilisateur voulu
    $maRequete = $pdo->prepare("SELECT `email` FROM `users` WHERE `email` = :email;");
    $maRequete->execute([
        ":email" => $mail
    ]);

    //récupère le résultat de la requète
    $user = $maRequete->fetch();
    if ($user == false && strcmp($mdp, $confirmMdp) == 0) { //si aucun résultat
        //j'ajoute le résultat du formulaire dans la database
        $maRequete = $pdo->prepare("INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`) VALUES(:first_name, :last_name, :email, :mdp)");
        $maRequete->execute([
            ":first_name" => $prenom,
            ":last_name" => $nom,
            ":email" => $mail,
            ":mdp" => $mdp
        ]);
        
        $maRequete = $pdo->prepare("SELECT `user_id`, `email`, `password`, `first_name`, `last_name`, `profil_picture`, `banner`, `status`, `theme` FROM `users` WHERE `email` = :email;");
        $maRequete->execute([
            ":email" => $mail
        ]);

        $user = $maRequete->fetch();

        $_SESSION["user"] = $user;

		// creating new user's stats
		$maRequete = $pdo->prepare("INSERT INTO `stats` (`user_id`) VALUES (:userId);");
		$maRequete->execute([
			":userId" => $_SESSION["user"]["user_id"]
		]);


        http_response_code(302);
        header('Location: /timeline'); //je vais à la page login
        exit();
    } elseif ($user == true){ //sinon
        $message = "L'utilisateur existe déjà";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
    } else {
        $message = "Les mots de passe ne correspondent pas";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
    }
}
//j'appelle l'html de cette page
require_once __DIR__ . '/../html_partial/sign_up.php';

$content = ob_get_clean(); //je stock le tampon dans cette variable

