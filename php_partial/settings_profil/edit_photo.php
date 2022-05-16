<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $target_dir = __DIR__ . "/../public/img_profil/";
    $full_name = $_FILES["fileToUpload"]["name"];
    $name_exploded = explode(".", $full_name);
    require __DIR__ . "/function/uuid.php";
    $file_name = guidv4($full_name);
    $extension = $name_exploded[1];
    $full_name = $file_name . "." . $extension;
    $target_file = $target_dir . basename($full_name);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["fileToUpload"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $message = "ce n'est pas une image";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/banniere.php";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $message = "l'image existe déjà";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
        $uploadOk = 0;
    }


    if ($_FILES["fileToUpload"]["size"] > 5971520) {
        $message = "image trop volumineuse";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
        $uploadOk = 0;
    }


    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message = "seulement jpg, png, jpeg et gif";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
        $uploadOk = 0;
    }

    if ($uploadOk === 0) {
        $message = "Une erreur est survenue";
        http_response_code(403);
        require_once __DIR__ . "/../html_partial/alert/banniere.php";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $maRequete = $pdo->prepare(
                "INSERT INTO `articles` (`content`, `user_id`, `picture`)
                VALUES(:content, :userId, :picture)"
            );
            $maRequete->execute([
                ":content" => $text,
                ":userId" => $user_id,
                ":picture" => $full_name
            ]);
            http_response_code(302);
            $direction = explode("/", $_SERVER["HTTP_REFERER"]);
            if ($direction[3] === "profile") {
                header("Location: /profile");
            } else if ($direction[3] === "timeline") {
                header("Location: /timeline");
            }
            exit();
        } else {
            $message = "Une erreur est survenue";
            http_response_code(403);
            require_once __DIR__ . "/../html_partial/alert/banniere.php";
        }
    }
}
