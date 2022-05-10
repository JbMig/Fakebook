<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["articleInput"])) {
        require_once __DIR__ . "/../database/pdo.php";
        $text = filter_input(INPUT_POST, "articleInput");
        $user_id = $_SESSION["user"]["user_id"];
        if($_FILES["fileToUpload"]["name"]) {
            require_once __DIR__ . "/upload_img_post.php";
        } else {
            $maRequete = $pdo->prepare(
                "INSERT INTO `articles` (`content`, `user_id`)
                VALUES(:content, :userId)");
                $maRequete->execute([
                    ":content" => $text,
                    ":userId" => $user_id
                ]);
            http_response_code(302);
            $direction = explode("/",$_SERVER["HTTP_REFERER"]);
            if($direction[3] === "profile") {
                header("Location: /profile");
            } else if ($direction[3] === "timeline") {
                header("Location: /timeline");
            }
            exit();
        }
    }
}
?>