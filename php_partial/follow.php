<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["follow"])) {
            // get info from form
            require "../database/pdo.php";
            $page_id = filter_input(INPUT_POST, "follow");
            $user_id = $_SESSION["user"]["user_id"];
			// delete relatioship from database
			$maRequete = $pdo->prepare("INSERT INTO `followers` (`page_id`,`user_id`) VALUES (:pageId, :userId);");
			$maRequete->execute([
				":pageId" => $page_id,
				":userId" => $user_id
			]);

			// go back to public_page
			http_response_code(302);

			header("Location: /public_page");
			exit();
		}
    }
?>