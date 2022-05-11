<?php
ob_start();
$user_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.

if($_SERVER["REQUEST_METHOD"] === "GET") {
	$title = "Fakebook - Profil de " . $user_id;
	
}




if($_SERVER["REQUEST_METHOD"] === "POST") {
	require_once __DIR__ . "/../database/pdo.php";  // accessing the database
	$profile_id = filter_input(INPUT_POST, "profil_id");

    $maRequete = $pdo->prepare("SELECT `user_id`, `email`, `password`, `first_name`, `last_name`, `profil_picture`, `banner`, `status` FROM `users` WHERE `user_id` = :profile_id;");
        $maRequete->execute([
            ":profile_id" => $profile_id
        ]);
	$profile = $maRequete->fetch();

	$title = "Fakebook - Profil de " . $profile["first_name"] . " " . $profile["last_name"];
	$h1 = $profile["first_name"] . " " . $profile["last_name"];


	$maRequete = $pdo->prepare("SELECT * FROM `articles` WHERE `user_id`=:profile_id ORDER BY `date` DESC"); // add condition for relationship
		$maRequete->execute([
			":profile_id" => $profile_id
		]);
		$articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);


}







require_once __DIR__ . "/../html_partial/profile.php";
$content = ob_get_clean();
?>