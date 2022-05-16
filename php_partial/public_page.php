<?php
ob_start();

require_once __DIR__ . "/../database/pdo.php";  // accessing the database

// WE SHOULDN'T NEED THIS :
// // if we got on the page with the url (without following a link), we end up on our own profile page
// if($_SERVER["REQUEST_METHOD"] === "GET") {
// 	$profile_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.
// 	$profile = $_SESSION["user"];
// }


// if we got on the page by clicking a link
// WE'LL NEED SOMETHING ON TIMELINE OR PROFILE TO ACCESS THE PAGE AND SAVE ITS ID.
if($_SERVER["REQUEST_METHOD"] === "POST") {
	$page_id = filter_input(INPUT_POST, "page_id");

    $maRequete = $pdo->prepare("SELECT `page_id`, `name`, `picture`, `banner`, `creation_date` FROM `pages` WHERE `page_id` = :pageId;");
        $maRequete->execute([
            ":pageId" => $page_id
        ]);
	$page = $maRequete->fetch();
}

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
$followers = $maRequete->fetch();
$nb_followers = COUNT($followers)

$is_follower = False;
foreach ($followers as $follower) {
	if ($follower['user_id'] === $_SESSION["user"]["user_id"]) {
		$is_follower = True;
	}
}

// getting the page's admins
$maRequete = $pdo->prepare("SELECT `follower_id`, `user_id` FROM `admins` WHERE `page_id` = :pageId;");
	$maRequete->execute([
		":pageId" => $page_id
	]);
$admins = $maRequete->fetch();

$is_admin = False;
foreach ($admins as $admin) {
	if ($admin['user_id'] === $_SESSION["user"]["user_id"]) {
		$is_admin = True;
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


require_once __DIR__ . "/../html_partial/profile.php";
$content = ob_get_clean();
?>