<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["articleInput"])) {
            require_once __DIR__ . "/../database/pdo.php";
            $text = filter_input(INPUT_POST, "articleInput");
            $user_id = $_SESSION["user"]["user_id"];
            if($_FILES["fileToUpload"]["name"]) {
                require_once __DIR__ . "/upload_img_post.php";
            } else {
				// 1st we create the article in the articles table
                $maRequete = $pdo->prepare(
                    "INSERT INTO `articles` (`content`, `user_id`)
                    VALUES(:content, :userId)");
                    $maRequete->execute([
                        ":content" => $text,
                        ":userId" => $user_id
                    ]);
				// then we adjust the writer's stats
				$maRequete = $pdo->prepare(
                    "SELECT `user_id`, `nb_article` FROM `stats`
					WHERE `user_id` = :userId;");
                    $maRequete->execute([
                        ":userId" => $user_id
                    ]);
				$nb_art = $maRequete->fetch();
				$new_nb_art = $nb_art + 1;

				$maRequete = $pdo->prepare(
                    "UPDATE `stats`
					SET `nb_article` = :new_nb_art
					WHERE `user_id` = :userId;");
                    $maRequete->execute([
                        ":userId" => $user_id,
                        ":new_nb_art" => $new_nb_art
                    ]);
					
                http_response_code(302);
                $direction = explode("/",$_SERVER["HTTP_REFERER"]);
                if($direction[3] === "profile") {
                    header("Location: /profile");
                } else if ($direction[3] === "timeline") {
                    header("Location: /timeline");
                }
                exit();
            }
        }
    }
?>