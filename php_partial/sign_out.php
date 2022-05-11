<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["deco"])) {
            // je vide la session
            unset($_SESSION["user"]);
            http_response_code(302);
            // je redirige vers /login
            header('Location: /login');
            exit();
        }
    }
?>