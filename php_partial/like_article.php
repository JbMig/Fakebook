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
				// unlike
                $maRequete = $pdo->prepare("DELETE FROM `likes` WHERE `like_id` = :likeId");
                $maRequete->execute([
                    ":likeId" => $user_like["like_id"]
                ]);

                $maRequete = $pdo->prepare("UPDATE `articles` SET `like_count` = `like_count` -1 WHERE `article_id` = :articleId");
                $maRequete->execute([
                    ":articleId" => $article_id
                ]);
                // updating stats of the liker
                $maRequete = $pdo->prepare(
                    "UPDATE `stats`
                    SET `nb_likes` = `nb_likes` - 1
                    WHERE `user_id` = :userId;");
                    $maRequete->execute([
                        ":userId" => $user_id
                    ]);
				// getting the article's writer's user_id
				$maRequete = $pdo->prepare(
					"SELECT `article_id`,`user_id`
					FROM `articles`
					WHERE `article_id` = :article_id2;");
					$maRequete->execute([
						":article_id2" => $article_id
				]);
				$article = $maRequete->fetch(PDO::FETCH_ASSOC);
				// updating stats of the article writer
                $maRequete = $pdo->prepare(
                    "UPDATE `stats`
                    SET `likes_on_articles` = `likes_on_articles` - 1
                    WHERE `user_id` = :Id;");
                    $maRequete->execute([
                        ":Id" => $article['user_id']
                    ]);
            } else {
				// like
                $maRequete = $pdo->prepare("INSERT INTO `likes` (`article_id`, `user_id`) VALUES(:article_id, :userId)");
                $maRequete->execute([
                    ":article_id" => $article_id,
                    ":userId" => $user_id
                ]);

                $maRequete = $pdo->prepare("UPDATE `articles` SET `like_count` = `like_count` +1 WHERE `article_id` = :articleId");
                $maRequete->execute([
                    ":articleId" => $article_id
                ]);
                // updating stats of the liker
                $maRequete = $pdo->prepare(
                    "UPDATE `stats`
                    SET `nb_likes` = `nb_likes` + 1
                    WHERE `user_id` = :userId;");
                    $maRequete->execute([
                        ":userId" => $user_id
                    ]);
				// getting the article's writer's user_id
				$maRequete = $pdo->prepare(
					"SELECT `article_id`,`user_id`
					FROM `articles`
					WHERE `article_id` = :article_id2;");
					$maRequete->execute([
						":article_id2" => $article_id
				]);
				$article = $maRequete->fetch(PDO::FETCH_ASSOC);
				// updating stats of the article writer
                $maRequete = $pdo->prepare(
                    "UPDATE `stats`
                    SET `likes_on_articles` = `likes_on_articles` + 1
                    WHERE `user_id` = :Id;");
                    $maRequete->execute([
                        ":Id" => $article['user_id']
                    ]);
            }


            http_response_code(302);
            // get the previous page
            $direction = explode("/",$_SERVER["HTTP_REFERER"]);
            // go to the previous page
            if($direction[3] === "profile") {
                header('Location: /profile');
            } else if ($direction[3] === "timeline") {
				header("Location: /timeline");
			} else if ($direction[3] === "public_page") {
				header("Location: /public_page");
			} else if ($direction[3] === "group") {
				header("Location: /group");
			}
            exit();
        }
    }

?>