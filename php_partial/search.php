<?php
ob_start();
require_once "../database/pdo.php";
$profile_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.
$who = filter_input(INPUT_POST,"search");
$who_name = explode(" ",$who);
$who_first_name = $who_name[0];
$who_last_name = $who_name[1];
$maRequete = $pdo->prepare('SELECT `user_id` ,`first_name`, `last_name` FROM `users` WHERE ((`first_name` LIKE :who_first_name) AND (`last_name` LIKE :who_last_name)) ORDER BY `user_id` DESC;');
$maRequete->execute([
    // ":who_last_name" => $who_last_name,
    ":who_last_name" => "%".$who_last_name."%",
    ":who_first_name" => "%".$who_first_name."%"
]);
$profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);
require_once __DIR__ . "/../html_partial/search.php";
$content = ob_get_clean(); //je stock le tampon dans cette variable

?>