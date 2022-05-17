<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];


// getting likes
$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $like = "like";


// getting all followed pages (cette requête fonctionne)
$maRequete = $pdo->prepare("SELECT `page_id`, `name`, `picture` FROM `pages` WHERE `page_id` IN (SELECT `page_id` FROM `followers` WHERE `user_id` = :userId);");
	$maRequete->execute([
		":userId" => $user_id
	]);
$followed_pages = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// $maRequete = $pdo->prepare("SELECT `page_id` FROM `pages` WHERE `page_id` IN (SELECT `page_id` FROM `followers` WHERE `user_id` = :userId);");
// 	$maRequete->execute([
// 		":userId" => $user_id
// 	]);
// $followed_pages_id = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$followed_pages_id = array();
foreach ($followed_pages as $followed_page) {
	array_push($followed_pages_id, $followed_page["page_id"]);
}

// var_dump($followed_pages_id);
// exit();

$maRequete = $pdo->prepare("SELECT `user_id_a` FROM `relationships` WHERE `user_id_b` = :userId AND `status`='approved';");
	$maRequete->execute([
		":userId" => $user_id
	]);
$friends_a = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$maRequete = $pdo->prepare("SELECT `user_id_b` FROM `relationships` WHERE `user_id_a` = :userId AND `status`='approved';");
	$maRequete->execute([
		":userId" => $user_id
	]);
$friends_b = $maRequete->fetchAll(PDO::FETCH_ASSOC);

$friends = array_merge($friends_a, $friends_b);
// jusqu'ici ça marche
// var_dump($friends);
// exit();

$maRequete = $pdo->prepare("SELECT * from `articles` WHERE `user_id` IN :friends OR `page_id` IN :followed_pages_id;");
	$maRequete->execute([
		":friends" => $friends,
		":followed_pages_id" => $followed_pages_id
	]);
$articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);
var_dump($articles);
exit();











require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>