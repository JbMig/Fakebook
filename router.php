<?php

// get url after first /
$uri = $_SERVER['REQUEST_URI'];

// if url =  
switch ($uri) {
    case "/login":
        require_once __DIR__ . '/php_partial/login.php';
        break;
    case "/profil":
        require_once __DIR__ . '/php_partial/profil.php';
        break;
}

// we require base_html to display $content(reference in files from php_partial)
require_once __DIR__ . '/html_partial/base_html.php';
?>