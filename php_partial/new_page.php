<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["pageInput"])) {
            require_once __DIR__ . "/../database/pdo.php";
            $page_name = filter_input(INPUT_POST, "pageInput");
            $page_description = filter_input(INPUT_POST, "descriptionInput");
            $user_id = $_SESSION["user"]["user_id"];
            // updating table pages
            $maRequete = $pdo->prepare(
                "INSERT INTO `pages` (`name`, `description`)
                VALUES(:page_name, :page_description)");
                $maRequete->execute([
                    ":page_name" => $page_name,
                    ":page_description" => $page_description
                ]);
			// get the new page's id
			$maRequete = $pdo->prepare(
                "SELECT `page_id` FROM `pages` WHERE `name` = :page_name");
                $maRequete->execute([
                    ":page_name" => $page_name
                ]);
			$page_id = $maRequete->fetch();

			// updating table admins
			$maRequete = $pdo->prepare(
                "INSERT INTO `admins` (`page_id`, `user_id`)
                VALUES(:pageId, :userId)");
                $maRequete->execute([
                    ":pageId" => $page_id,
                    ":userId" => $user_id
                ]);


            http_response_code(302);
            header("Location: /public_page");
            
            exit();
        }
    }
?>