<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once "../database/pdo.php";
        $content = filter_input(INPUT_POST, "new_message");
        $chat_id = filter_input(INPUT_POST, "chat_id");
        $user_id = $_SESSION["user"]["user_id"];

        $maRequete = $pdo->prepare("INSERT INTO `messages` (`content`, `chat_id`, `user_id`) VALUES(:content, :chatId, :userId)");
        $maRequete->execute([
            ":content" => $content,
            ":chatId" => $chat_id,
            ":userId" => $user_id
        ]);

        http_response_code(302);
        header('Location: /chat'); //je vais à la page login
        exit();
    }

    require_once "../database/pdo.php";
    $user_id = $_SESSION["user"]["user_id"];
    $chat_id = $_SESSION["chat"]["chat_id"];
    $members = $_SESSION["chat_members"];

    $maRequete = $pdo->prepare("SELECT * FROM `messages` WHERE `chat_id` = :chatId ORDER BY `date`");
    $maRequete->execute([
        ":chatId" => $chat_id
    ]);
    $messages = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode([
        "members" => $_SESSION["chat_members"],
        "user" => $_SESSION["user"],
        "messages" => $messages
    ]);
    exit();
?>