<<<<<<< HEAD
 <?php
    //mise en tampon pour stockage dans une variable
    ob_start();
    //valeur pour la balisehtml <title>
    $title = "login";

    // si on est en method POST, on reçoit les donnée du formulaire
    //permet de verifier l'utilisateur dans la base de donnée pour créer un connexion
    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
        $mail = filter_input(INPUT_POST, "email"); //récupère le mail du formulaire
        //récupère le mdp du formulaire
        $mdp = hash("sha512", filter_input(INPUT_POST, "mdp"));
        //requete sql pour trouver dans la database l'utilisateur voulu
        $maRequete = $pdo->prepare("SELECT `id`, `email`, `password` FROM `user_id` WHERE `email` = :email;");
        $maRequete->execute([
            ":email" => $mail
        ]);
        //récupère le résultat de la requète
        $user = $maRequete->fetch();
        //si aucun résultat ou si le mot de passe est invalide
        if (!$user || $user["password"] !== $mdp) {
            $message = "Utilisateur invalide";
            //indique que le serveur refuse d'autoriser la requête 
            http_response_code(403);
            //j'appelle ma bannière html pour afficher un message d'erreur
            require_once __DIR__ . "/../html_partial/alert/banniere.php";
        } else { //sinon j'ajoute le resultat de la requete dans la session
            $_SESSION["user_id"] = $user;
            header("Location: /projet"); //je vais à la page projet
            exit();
        }
=======
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
    $maRequete = $pdo->prepare("SELECT `user_id`, `email`, `password` FROM `users` WHERE `email` = :email;");
    $maRequete->execute([
        ":email" => $mail
    ]);
    //récupère le résultat de la requète
    $user = $maRequete->fetch();
    //si aucun résultat ou si le mot de passe est invalide
    if (!$user || $user["password"] !== $mdp) {
        var_dump($mail) . PHP_EOL;
        var_dump($mdp);
        $message = "Utilisateur invalide";
        //indique que le serveur refuse d'autoriser la requête 
        http_response_code(403);
        //j'appelle ma bannière html pour afficher un message d'erreur
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
    } else { //sinon j'ajoute le resultat de la requete dans la session
        $_SESSION["user_id"] = $user;
        header("Location: /timeline"); //je vais à la page projet
        exit();
>>>>>>> main
    }
    //j'appelle l'html de cette page
    require_once __DIR__ . "/../html_partial/login.php";

<<<<<<< HEAD
    $content = ob_get_clean(); //je stock le tampon dans cette variable
=======
$content = ob_get_clean(); //je stock le tampon dans cette variable
>>>>>>> main
