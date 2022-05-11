<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["modify_article"])) {
            require "../database/pdo.php";
            // get info from form
            $user_id = $_SESSION["user"]["user_id"];
            $data = filter_input(INPUT_POST, "modify_article");
            $article_user = filter_input(INPUT_POST, "article_user");
            $article_id = filter_input(INPUT_POST, "article_id");
            if($article_user === $user_id) {
                // update the article
                $maRequete = $pdo->prepare("UPDATE `articles` SET `content`= :oneData, `date` = CURRENT_TIMESTAMP WHERE `article_id` = :article_id");
                $maRequete->execute([
                    ":oneData" => $data,
                    "article_id" => $article_id
                ]);
                http_response_code(302);
                // get the previous page
                $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                    // got to the previous page
                    if($direction[3] === "profile") {
                        header('Location: /profile');
                    } else {
                        header('Location: /timeline');
                    }
                exit();
            } else {
                $message = "cet article n'est pas de vous"; 
                http_response_code(403);
                require_once __DIR__ . "/../html_partial/alert/baniere.php";
            }
        }
    }
?>