<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if(isset($_POST["member_approval"])) {
            // get info from form
            require "../database/pdo.php";
            $profile_id = filter_input(INPUT_POST, "member_approval");
            $group_id = $_SESSION["group"]["group_id"];
			// delete relatioship from database
			$maRequete = $pdo->prepare("UPDATE `members` SET `status` = 'approved' WHERE `group_id` = :groupId AND `profile_id` = :profile_id");
			$maRequete->execute([
				":profile_id" => $profile_id,
				":groupId" => $group_id
			]);
			
			// go back to group
			http_response_code(302);

			header("Location: /group");
			exit();
		}
    }
?>