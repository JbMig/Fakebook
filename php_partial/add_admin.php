<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["new_admin"])) {
            // get info from form
            require "../database/pdo.php";
            $page_id = filter_input(INPUT_POST, "new_admin_page");
            $profile_id = filter_input(INPUT_POST, "new_admin_account");
			var_dump($page_id);
			var_dump($profile_id);
			exit();

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