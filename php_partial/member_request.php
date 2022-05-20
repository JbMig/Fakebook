<?php
$user_id = $_SESSION["user"]["user_id"];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["member_request"])) {
        require_once __DIR__ . "/../database/pdo.php";
        $group_id = filter_input(INPUT_POST, 'member_request');
		
		// getting the group's status (private/public)
	
		$maRequete = $pdo->prepare(
			"SELECT `status` FROM `groups` WHERE `group_id`=:groupId");
			$maRequete->execute([
				":groupId" => $group_id
			]);
		$privacy = $maRequete->fetch();

		if($privacy==='public') {
			$status = 'approved';
		} else {
			$status = 'pending';
		}

		$maRequete = $pdo->prepare(
			"INSERT INTO `members` (`user_id`, `group_id`, `status`)
			VALUES(:userId, :groupId, :st)");
			$maRequete->execute([
				":userId" => $user_id,
				":groupId" => $group_id,
				":st" => $status
			]);

		// pbm : it seems we're switching to method "get" here so we end up on our own group page instead of our friend's.
		http_response_code(302);
		// $direction = explode("/",$_SERVER["HTTP_REFERER"]);
		header("Location: /group");
		exit();
    }
}
?>