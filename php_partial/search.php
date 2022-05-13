<?php
ob_start();
require_once "../database/pdo.php";
$profile_id = $_SESSION["user"]["user_id"]; // needed to check whether it's the user's page or someone else's.

<!-- // $user_id = $_SESSION["user"]["user_id"];
//         $test = filter_input(INPUT_POST,"search");
//         $name = explode(" ",$test);
//         $name_1=$name[0];
//         $name_2=$name[1];
//         var_dump($name_2);
//         while(strlen($name_1) > 0 && strlen($name_2) > 0){
//             if (strlen($name_1) > 0){
//                 $name_1=substr($name_1,0,-1);
//                 var_dump($name_1);
//             }
//             if(strlen($name_2)>0){
//                 $name_2=substr($name_2,0,-1);
//                 var_dump($name_2);
//             }
//         } -->
$maRequete = $pdo->prepare("SELECT `first_name`, `last_name` FROM `users`;");
    $maRequete->execute();
$profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);


require_once __DIR__ . "/../html_partial/search.php";
$content = ob_get_clean(); //je stock le tampon dans cette variable
?>