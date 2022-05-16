<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["commentInput"])) {
            require_once __DIR__ . "/../database/pdo.php";
            $text = filter_input(INPUT_POST, "commentInput");
            $article_id = filter_input(INPUT_POST, "article_id");
            $user_id = $_SESSION["user"]["user_id"];
            
            $maRequete = $pdo->prepare(
                "INSERT INTO `comments` (`content`, article_id, `user_id`)
                VALUES(:content, :article_id, :userId)");
                $maRequete->execute([
                    ":content" => $text,
                    ":article_id" => $article_id,
                    ":userId" => $user_id
                ]);
			// updating stats of the commenter
			$maRequete = $pdo->prepare(
				"UPDATE `stats`
				SET `nb_comments` = `nb_comments` + 1
				WHERE `user_id` = :userId2;");
				$maRequete->execute([
					":userId2" => $user_id
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
			// updating stats of the article's writer
			$maRequete = $pdo->prepare(
				"UPDATE `stats`
				SET `comments_on_articles` = `comments_on_articles` + 1
				WHERE `user_id` = :id;");
				$maRequete->execute([
					":id" => $article['user_id']
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
?>