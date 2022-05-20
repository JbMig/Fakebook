<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["member_removal"])) {
            // get info from form
            require "../database/pdo.php";
            $profile_id = filter_input(INPUT_POST, "member_removal");
            $group_id = $_SESSION["group"]["group_id"];

			// delete ship from database
			$maRequete = $pdo->prepare("DELETE FROM `relationships`WHERE `group_id` = :groupId AND `profile_id` = :profile_id;");
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