<?php

// get url after first /
$uri = $_SERVER["REQUEST_URI"];

if ($uri == "/entrer.php") {
    // if no user in session
    if (!isset($_SESSION["user"])) {
        // we go to login
        header("Location: /login");
        exit;
    } else { // we go to timeline
        header("Location: /timeline");
        exit;
    }
// else if we are not in login or signup
} else if ($uri != "/login" && $uri != "/sign_up") {
    // if no user in session
    if (!isset($_SESSION["user"])) {
        // we go to login
        header("Location: /login");
        exit;
    }
}

// if url =  "..." require the files "..."
switch ($uri) {
    case "/login":
        require_once __DIR__ . "/php_partial/login.php";
        break;
    case "/sign_up":
        require_once __DIR__ . "/php_partial/sign_up.php";
        break;
    case "/sign_out":
        require_once __DIR__ . "/php_partial/sign_out.php";
        break;
    case "/profile":
        require_once __DIR__ . "/php_partial/profile.php";
        break;
    case "/theme":
        require_once __DIR__ . "/php_partial/theme.php";
        break;
    case "/timeline":
        require_once __DIR__ . "/php_partial/timeline.php";
        break;
    case "/new_article":
        require_once __DIR__ . "/php_partial/new_article.php";
        break;
    case "/new_article_page":
        require_once __DIR__ . "/php_partial/new_article_page.php";
        break;
    case "/delete_article":
        require_once __DIR__ . "/php_partial/delete_article.php";
        break;
    case "/friend_request":
        require_once __DIR__ . "/php_partial/friend_request.php";
        break;
    case "/friend_request":
        require_once __DIR__ . "/php_partial/friend_request.php";
        break;
    case "/friend_removal":
        require_once __DIR__ . "/php_partial/friend_removal.php";
        break;
    case "/friend_approval":
        require_once __DIR__ . "/php_partial/friend_approval.php";
        break;
    case "/block":
        require_once __DIR__ . "/php_partial/block.php";
        break;
    case "/delete":
        require_once __DIR__ . "/php_partial/delete.php";
        break;
    case "/inactive":
        require_once __DIR__ . "/php_partial/inactive.php";
    case "/modify_article":
        require_once __DIR__ . "/php_partial/modify_article.php";
        break;
    case "/settings_profil":
        require_once __DIR__ . "/php_partial/settings_profil/settings_profil.php";
        break;
    case "/new_first_name":
        require_once __DIR__ . "/php_partial/settings_profil/new_first_name.php";
        break;
    case "/new_last_name":
        require_once __DIR__ . "/php_partial/settings_profil/new_last_name.php";
        break;
    case "/new_password":
        require_once __DIR__ . "/php_partial/settings_profil/new_password.php";
        break;
    case "/new_email":
        require_once __DIR__ . "/php_partial/settings_profil/new_email.php";
        break;
    case "/edit_photo":
        require_once __DIR__ . "/php_partial/settings_profil/edit_photo.php";
        break;
    case "/edit_banniere":
        require_once __DIR__ . "/php_partial/settings_profil/edit_banniere.php";
    case "/like_article":
        require_once __DIR__ . "/php_partial/like_article.php";
        break;
    case "/new_comment":
        require_once __DIR__ . "/php_partial/new_comment.php";
        break;
    case "/like_comment":
        require_once __DIR__ . "/php_partial/like_comment.php";
        break;
    case "/delete_comment":
        require_once __DIR__ . "/php_partial/delete_comment.php";
        break;
    case "/modify_comment":
        require_once __DIR__ . "/php_partial/modify_comment.php";
        break;
    case "/search":
        require_once __DIR__ . "/php_partial/search.php";
        break;
    case "/public_page":
        require_once __DIR__ . "/php_partial/public_page.php";
        break;
    case "/follow":
        require_once __DIR__ . "/php_partial/follow.php";
        break;
    case "/unfollow":
        require_once __DIR__ . "/php_partial/unfollow.php";
        break;
    case "/remove_admin":
        require_once __DIR__ . "/php_partial/remove_admin.php";
        break;
    case "/add_admin":
        require_once __DIR__ . "/php_partial/add_admin.php";
        break;
    case "/new_page":
        require_once __DIR__ . "/php_partial/new_page.php";
    case "/new_chat":
        require_once __DIR__ . "/php_partial/messenger/new_chat.php";
        break;
    case "/conversation":
        require_once __DIR__ . "/php_partial/messenger/conversation.php";
        break;
    case "/chat":
        require_once __DIR__ . "/php_partial/messenger/chat.php";
        break;
    case "/new_message":
        require_once __DIR__ . "/php_partial/messenger/new_message.php";
        break;
    case "/brouillon_timeline":
        require_once __DIR__ . "/../brouillon_timeline.php";
		break;
    case "/chat2":
        require_once __DIR__ . "/php_partial/messenger/chat2.php";
        break;
    case "/change_chat_img":
        require_once __DIR__ . "/php_partial/messenger/change_chat_img.php";
        break;
    case "/quit_chat":
        require_once __DIR__ . "/php_partial/messenger/quit_chat.php";
        break;
}

// we require base_html to display $content ($content references in files from php_partial)
require_once __DIR__ . "/html_partial/base_html.php";
