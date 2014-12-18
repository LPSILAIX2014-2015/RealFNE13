<?php
$vnav = new VNav();
$vpage = new $page['class']();
global $connec;
//$connec = new db();
$vHtml = new VHtml() ;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="Css/main.css" />
    <link rel="stylesheet" type="text/css" href="Lib/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="Lib/bootstrap.icon-large.min.css" />
    <link rel="icon" type="image/png" href="Img/favicon.png" />

</head>
<body>
    <?php $vHtml->showHtml('Html/loginForm.php'); ?>
    <nav>
        <?php $vnav->showNav(); ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']); ?>
    </div>
    <script src="Lib/jquery.min.js"></script>
    <script src="Lib/bootstrap.min.js"></script>
    <script src="JS/createArticle.js"></script>

</body>