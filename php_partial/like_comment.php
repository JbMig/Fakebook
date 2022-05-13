<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["like_comment_id"])) {

            require_once "../database/pdo.php";
            $comment_id = filter_input(INPUT_POST, "like_comment_id");
            $user_id = $_SESSION["user"]["user_id"];

            $maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId AND `comment_id` = :commentId");
            $maRequete->execute([
                "userId" => $user_id,
                ":commentId" => $comment_id
            ]);
            $user_like = $maRequete->fetch();
            if($user_like) {
                $maRequete = $pdo->prepare("DELETE FROM `likes` WHERE `like_id` = :likeId");
                $maRequete->execute([
                    ":likeId" => $user_like["like_id"]
                ]);

                $maRequete = $pdo->prepare("UPDATE `comments` SET `like_count` = `like_count` -1 WHERE `comment_id` = :commentId");
                $maRequete->execute([
                    ":commentId" => $comment_id
                ]);

            } else {
                $maRequete = $pdo->prepare("INSERT INTO `likes` (`comment_id`,`user_id`) VALUES(:comment_id, :userId)");
                $maRequete->execute([
                    ":comment_id" => $comment_id,
                    ":userId" => $user_id
                ]);

                $maRequete = $pdo->prepare("UPDATE `comments` SET `like_count` = `like_count` +1 WHERE `comment_id` = :commentId");
                $maRequete->execute([
                    ":commentId" => $comment_id
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