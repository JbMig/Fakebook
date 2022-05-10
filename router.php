<?php

// get url after first /
$uri = $_SERVER["REQUEST_URI"];

// if url =  "..." require the files "..."
switch ($uri) {
    case "/login":
        require_once __DIR__ . "/php_partial/login.php";
        break;
    case "/sign_up":
        require_once __DIR__ . "/php_partial/sign_up.php";
        break;
    case "/profile":
        require_once __DIR__ . "/php_partial/profile.php";
        break;
    case "/timeline":
        require_once __DIR__ . "/php_partial/timeline.php";
        break;
}

// we require base_html to display $content ($content references in files from php_partial)
require_once __DIR__ . "/html_partial/base_html.php";
?>