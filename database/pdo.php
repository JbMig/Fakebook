<?php
$engine = "mysql";
$host = "localhost";
$port = 3306; //à modiffier si besoin
$dbname = "db_fakebook_ajltvv";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
?>