<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titre"><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="style/style.css?<?php echo time();?>">
</head>
<body>
    <header>
    </header>
    <main>
        <!-- Affiche $content ici -->
        <?= $content ?>
    </main>

    <footer>
        <!-- require the right script by checking url -->
        <?php require_once __DIR__ . "/../php_partial/get_script.php"; ?>
    </footer>
</body>
</html>