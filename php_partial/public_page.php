<?php
ob_start();

require_once __DIR__ . "/../database/pdo.php";  // accessing the database

// updating $_SESSION["page"]
$page_id = $_SESSION["page"]["page_id"];
$maRequete = $pdo->prepare(
	"SELECT * FROM `pages` WHERE `page_id` = :pageId;");
	$maRequete->execute([
		":pageId" => $page_id
	]);
$current_page = $maRequete->fetch();
$_SESSION["page"] = $current_page;



if($_SERVER["REQUEST_METHOD"] === "POST") {
	header("Location: /timeline");
	exit();
}
$user_id = $_SESSION["user"]["user_id"];
$page_id = $_SESSION["page"]["page_id"];
//var_dump($page_id);
$page = $_SESSION["page"];

// displaying the page's name and its past articles
$title = "Fakebook - Page " . $page["name"];
$h1 = $page["name"];
$maRequete = $pdo->prepare("SELECT * FROM `articles` WHERE `page_id` = :pageId ORDER BY `date` DESC");
$maRequete->execute([
	":pageId" => $page_id
]);
$articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// getting the page's stats
$nb_articles = Count($articles);

$maRequete = $pdo->prepare("SELECT `follower_id`, `user_id` FROM `followers` WHERE `page_id` = :pageId;");
	$maRequete->execute([
		":pageId" => $page_id
	]);
$followers = $maRequete->fetchAll(PDO::FETCH_ASSOC);
$nb_followers = COUNT($followers);

//var_dump($followers);
$accounts = array();

foreach ($followers as $follower) {
	if ($follower['user_id'] === $_SESSION["user"]["user_id"]) {
		$is_follower = TRUE;
		$maRequete = $pdo->prepare("SELECT `user_id`, `first_name`, `last_name` FROM `users` WHERE `user_id` = :Id;");
			$maRequete->execute([
				":Id" => $follower['user_id']
			]);
			$maRequete->setFetchMode(PDO::FETCH_ASSOC);
		array_push($accounts, $maRequete->fetch());
	}
	else {
		$is_follower = FALSE;
	}
}
var_dump($accounts);
// getting the page's admins
$maRequete = $pdo->prepare("SELECT `admin_id`, `user_id` FROM `admins` WHERE `page_id` = :pageId;");
	$maRequete->execute([
		":pageId" => $page_id
	]);
$admins = $maRequete->fetchAll(PDO::FETCH_ASSOC);


foreach ($admins as $admin) {
	if ($admin['user_id'] === $_SESSION["user"]["user_id"]) {
		$is_admin = TRUE;
	}
	else {
		$is_admin = FALSE;
	}
}

// checking whether we're friends with the person
$profile_id = filter_input(INPUT_POST, "profil_id");

$maRequete = $pdo->prepare("SELECT `user_id_a`, `user_id_b`, `status`, `blocked` FROM `relationships` WHERE ((`user_id_a` = :profile_id AND `user_id_b` = :userId) OR (`user_id_b` = :profile_id AND `user_id_a` = :userId)) AND `status`='approved';");
        $maRequete->execute([
            ":profile_id" => $profile_id,
			":userId" => $_SESSION["user"]["user_id"]
        ]);
	$profile_friend = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// pending friend requests
$maRequete = $pdo->prepare("SELECT `user_id_a`, `user_id_b`, `status`, `blocked` FROM `relationships` WHERE ((`user_id_a` = :profile_id AND `user_id_b` = :userId) OR (`user_id_b` = :profile_id AND `user_id_a` = :userId) AND `status`='pending');");
	$maRequete->execute([
		":profile_id" => $profile_id,
		":userId" => $_SESSION["user"]["user_id"]
	]);
$profile_friend_request = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $like = "like";

require_once __DIR__ . "/../html_partial/public_page.php";
$content = ob_get_clean();
?>