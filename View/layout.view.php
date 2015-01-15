<?php
$vnav = new VNav();
$vUserInfo = new VUserInfo();
$vpage = new $page['class']();
global $connec;
$connec = new MDBase();
$vHtml = new VHtml() ;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
        <link rel="stylesheet" href="./Css/style.css">

        <link rel="stylesheet" href="./Css/reset.css">  
        <link rel="stylesheet" type="text/css" href="./Lib/bootstrap.min.css" />

        <link rel="stylesheet" type="text/css" href="./Css/main.css" />

        <link rel="stylesheet" href="./Css/jquery-ui.css">

    <link rel="stylesheet" href="./Css/jquery.fancybox.css" media="screen">
    <?php
    // Ajout feuille de style spécifique à cette page
    if (isset($page['css'])) {
        echo '<link rel="stylesheet" type="text/css" href="'.$page['css'].'" />' ;
    }
    ?>
    <link rel="stylesheet" type="text/css" href="Lib/bootstrap.icon-large.min.css" />
    <link rel="icon" type="image/png" href="Img/favicon.png" />
    <script src="Lib/jquery.min.js"></script>
    <script src="Lib/bootstrap.min.js"></script>
    <script src="./Js/form.js"></script>
    <script src="./Lib/jquery-ui.js"></script>
    <script src="./Lib/jquery.fancybox.pack.js"></script>
    <script src="./Lib/jquery.fancybox.js"></script>
    <script src="./Lib/jquery.form.js"></script>
    <script src="./Lib/jquery.validate.js"></script>
    <script src="./Js/recMP.js"></script>
</head>
<body>
    <?php
    if(!isset($user)) {
        $vHtml->showHtml('Html/loginForm.php');
    }
    else
    {
        $vHtml->showHtml('Html/userInfo.php');
    }
    ?>
    <nav>
        <?php $vnav->showNav() ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']) ?>
    </div>
    <div class="footer">
    	<a href="index.php?EX=legal">Site r&eacute;alis&eacute; par la LP SIL DA2I 20014- IUT d'Aix-en-Provence, pour le compte de la FNE13</a>
    </div>

    <script src="Js/createArticle.js"></script>
</body>
