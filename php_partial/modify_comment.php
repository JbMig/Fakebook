<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["modify_comment"])) {
            require "../database/pdo.php";
            // get info from form
            $user_id = $_SESSION["user"]["user_id"];
            $data = filter_input(INPUT_POST, "modify_comment");
            $comment_user = filter_input(INPUT_POST, "comment_user");
            $comment_id = filter_input(INPUT_POST, "comment_id");
            if($comment_user === $user_id) {
                // update the comment
                $maRequete = $pdo->prepare("UPDATE `comments` SET `content`= :oneData, `date` = CURRENT_TIMESTAMP WHERE `comment_id` = :comment_id");
                $maRequete->execute([
                    ":oneData" => $data,
                    "comment_id" => $comment_id
                ]);
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
            } else {
                $message = "cet comment n'est pas de vous"; 
                http_response_code(403);
                require_once __DIR__ . "/../html_partial/alert/baniere.php";
            }
        }
    }
?>