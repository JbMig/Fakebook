<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["friend_approval"])) {
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

			// go back to profile
			http_response_code(302);

			header("Location: /timeline"); // later, change this to /public_page (we need to save which page)
			exit();
		}
    }
?>