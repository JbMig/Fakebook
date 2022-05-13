<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["like_article_id"])) {

            require_once "../database/pdo.php";
            $article_id = filter_input(INPUT_POST, "like_article_id");
            $user_id = $_SESSION["user"]["user_id"];

            $maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId AND `article_id` = :articleId");
            $maRequete->execute([
                "userId" => $user_id,
                ":articleId" => $article_id
            ]);
            $user_like = $maRequete->fetch();
            if($user_like) {
                $maRequete = $pdo->prepare("DELETE FROM `likes` WHERE `like_id` = :likeId");
                $maRequete->execute([
                    ":likeId" => $user_like["like_id"]
                ]);

                $maRequete = $pdo->prepare("UPDATE `articles` SET `like_count` = `like_count` -1 WHERE `article_id` = :articleId");
                $maRequete->execute([
                    ":articleId" => $article_id
                ]);

            } else {
                $maRequete = $pdo->prepare("INSERT INTO `likes` (`article_id`, `user_id`) VALUES(:article_id, :userId)");
                $maRequete->execute([
                    ":article_id" => $article_id,
                    ":userId" => $user_id
                ]);

                $maRequete = $pdo->prepare("UPDATE `articles` SET `like_count` = `like_count` +1 WHERE `article_id` = :articleId");
                $maRequete->execute([
                    ":articleId" => $article_id
                ]);

            }

            http_response_code(302);
            // get the previous page
            $direction = explode("/",$_SERVER["HTTP_REFERER"]);
            // go to the previous page
            if($direction[3] === "profile") {
                header('Location: /profile');
            } else {
                header('Location: /timeline');
            }
            exit();
        }
    }

?>