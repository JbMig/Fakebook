<?php
ob_start();
require_once "../database/pdo.php"; 


if(isset($_POST["someone"])) {
    $who = filter_input(INPUT_POST,"someone");
    $who_name = explode(" ",$who);
    $who_first_name = $who_name[0];
    if(!isset($who_last_name)) {
        $who_last_name = "";
    } else {
        $who_last_name = $who_name[1];
    }
    $maRequete = $pdo->prepare('SELECT `user_id` ,`first_name`, `last_name` , `profil_picture` FROM `users` WHERE ((`first_name` LIKE :who_first_name) AND (`last_name` LIKE :who_last_name)) ORDER BY `user_id` DESC;');
    $maRequete->execute([
        // ":who_last_name" => $who_last_name,
        ":who_last_name" => "%".$who_last_name."%",
        ":who_first_name" => "%".$who_first_name."%"
    ]);
    $profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);


    $maRequete = $pdo->prepare('SELECT `user_id` ,`first_name`, `last_name` , `profil_picture` FROM `users` ');
    $maRequete->execute();
    $names = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    require_once __DIR__ . "/../html_partial/search_someone.php";
    }


if(isset($_POST["group"])) {
    $group_id = $_SESSION["group"]["group_id"];
    $who = filter_input(INPUT_POST,"group");
    $maRequete = $pdo->prepare('SELECT `group_id` , `name` , `picture` , `banner` FROM groups WHERE (`name` LIKE :who_name) ORDER BY `group_id` DESC;');
    $maRequete->execute([
        // ":who_last_name" => $who_last_name,
        ":who_name" => "%".$who."%"
    ]);
    $groups = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    
    $maRequete = $pdo->prepare('SELECT `group_id` , `name` , `picture` , `banner` FROM groups ;');
    $maRequete->execute();
    $names = $maRequete->fetchAll(PDO::FETCH_ASSOC);

    require_once __DIR__ . "/../html_partial/search_group.php";
    }

if(isset($_POST["page"])) {
    $page_id = $_SESSION["page"]["page_id"];
    $who = filter_input(INPUT_POST,"page");
    $maRequete = $pdo->prepare('SELECT `page_id` , `name` , `picture` , `banner` FROM pages WHERE (`name` LIKE :who_name) ORDER BY `page_id` DESC;');
    $maRequete->execute([
        // ":who_last_name" => $who_last_name,
        ":who_name" => "%".$who."%"
    ]);
    $pages = $maRequete->fetchAll(PDO::FETCH_ASSOC);
        
    $maRequete = $pdo->prepare('SELECT `page_id` , `name` , `picture` , `banner` FROM pages ');
    $maRequete->execute();
    $names = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    
    require_once __DIR__ . "/../html_partial/search_page.php";
    }

$content = ob_get_clean(); //je stock le tampon dans cette variable

?>