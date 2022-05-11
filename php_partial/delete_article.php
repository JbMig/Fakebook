<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["article_id"])) {
            // get info from form
            require "../database/pdo.php";
            $article_id = filter_input(INPUT_POST, "article_id");
            $article_user = filter_input(INPUT_POST, "article_user");
            $user_id = $_SESSION["user"]["user_id"];
            // if user_id = article_id, i can delete the article
            if($article_user === $user_id) {
                if($article_id) {
                    // delete article
                    $maRequete = $pdo->prepare("DELETE FROM `articles` WHERE `article_id` = :id");
                    $maRequete->execute([
                        ":id" => $article_id
                    ]);
                    // go to last location
                    http_response_code(302);
                    $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                    if($direction[3] === "profile") {
                        header("Location: /profile");
                    } else if ($direction[3] === "timeline") {
                        header("Location: /timeline");
                    }
                    exit();
                }
            } else {
                $message = "cet article n'est pas de vous"; 
                http_response_code(403);
                require_once __DIR__ . "/../html_partial/alert/baniere.php";
            }
        }
    }
?>