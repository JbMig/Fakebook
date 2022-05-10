<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";
$_SESSION["users"]["user_id"] = 1;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["articleInput"])) {
        require_once __DIR__ . "/../database/pdo.php";
        $text = filter_input(INPUT_POST, "articleInput");
        $user_id = $_SESSION["users"]["user_id"];
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
            header("location: /timeline");
            exit();
        }
    }
}

require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>