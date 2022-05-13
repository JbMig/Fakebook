<?php
ob_start();
require_once "../database/pdo.php";
$profile_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.
$who = filter_input(INPUT_POST,"search");
$who_name = explode(" ",$who);
$who_first_name = $who_name[0];
$who_last_name = $who_name[1];
$memory = [];
$i=0;
$maRequete = $pdo->prepare("SELECT `user_id` ,`first_name`, `last_name` FROM `users` HAVING (`first_name` = :who_first_name) AND (`last_name` = :who_last_name) IF (`user_id` != :memory ;");
$maRequete->execute([
    ":who_last_name" => $who_name[1],
    ":who_first_name" => $who_name[0]
    ":memory" => $memory[i]
]);
$profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);
require_once __DIR__ . "/../html_partial/search.php";
$content = ob_get_clean(); //je stock le tampon dans cette variable

?>