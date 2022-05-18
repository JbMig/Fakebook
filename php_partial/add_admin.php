<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["follow"])) {
            // get info from form
            require "../database/pdo.php";
            $page_and_profile = filter_input(INPUT_POST, "new_admin");
            $page_id = $page_and_profile[0];
            $profile_id = $page_and_profile[1];
			// delete relatioship from database
			$maRequete = $pdo->prepare("INSERT INTO `admins` (`page_id`,`user_id`) VALUES (:pageId, :profileId);");
			$maRequete->execute([
				":pageId" => $page_id,
				":profileId" => $profile_id
			]);

			// go back to public_page
			http_response_code(302);

			header("Location: /public_page");
			exit();
		}
    }
?>