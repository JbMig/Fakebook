<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titre"><?=$title?></title>
    <?php $_SESSION["user"]["theme"] = 0; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    <link rel="stylesheet" type="text/css" href="/style/style.css?<?php echo time();?>">
    <?php require_once __DIR__ . "/../php_partial/get_style.php";?>
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