<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(isset($_POST["article_id"])) {
            // get info from form
            require "../database/pdo.php";
            $profile_id = filter_input(INPUT_POST, "profile_id");
            $user_id = $_SESSION["user"]["user_id"];
            // if user_id = article_id, i can delete the article

			// delete relatioship from the database
			$maRequete = $pdo->prepare("DELETE FROM `relationships` WHERE (`user_id_a` = :profile_id AND `user_id_b` = :userId) OR (`user_id_b` = :profile_id AND `user_id_a` = :userId)");
			$maRequete->execute([
				":profile_id" => $profile_id,
				":userId" => $user_id
			]);
			// go to last location
			http_response_code(302);

			header("Location: /profile");

			exit();

        }
    }
?>