<?php
    ob_start();
    if ("POST" === $_SERVER["REQUEST_METHOD"]) {
        require_once __DIR__ . "/../database/pdo.php"; //je récupère le PDO
        
        $user_id = $_SESSION["user"]["user_id"];
        $test = filter_input(INPUT_POST,"search");
        $name = explode(" ",$test);
        $name_1=$name[0];
        $name_2=$name[1];
        var_dump($name_2);
        while(strlen($name_1) > 0 && strlen($name_2) > 0){
            if (strlen($name_1) > 0){
                $name_1=substr($name_1,0,-1);
                var_dump($name_1);
            }
            if(strlen($name_2)>0){
                $name_2=substr($name_2,0,-1);
                var_dump($name_2);
            }
        }
    }
    require_once __DIR__ . "/../html_partial/search.php";
    $content = ob_get_clean(); //je stock le tampon dans cette variable
?>