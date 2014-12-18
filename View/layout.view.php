<<<<<<< HEAD
<?php
$vnav = new VNav();
$vpage = new $page['class']();
global $connec;
$connec = new DBase();
$vHtml = new VHtml() ;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="Lib/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="Css/main.css" />
    <?php
	// Ajout feuille de style spécifique à cette page
	if (isset($page['css'])) {
		echo '<link rel="stylesheet" type="text/css" href="'.$page['css'].'" />' ;
	}
    ?>
    <link rel="icon" type="image/png" href="Img/favicon.png" />
    <script src="Lib/jquery.min.js"></script>
    <script src="Lib/bootstrap.min.js"></script>

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
        <?php $vnav->showNav(); ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']); ?>
    </div>
    <div class="footer">
    	<a href="index.php?EX=legal">Site r&eacute;alis&eacute; par la LP SIL DA2I 20014- IUT d'Aix-en-Provence, pour le compte de la FNE13</a>
    </div>
    <script src="Lib/jquery.min.js"></script>
    <script src="Lib/bootstrap.min.js"></script>
</body>
=======
<?php
$vnav = new VNav();
$vUserInfo = new VUserInfo();
$vpage = new $page['class']();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link href="../Css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../Css/main.css" />
    <link rel="stylesheet" type="text/css" href="../Css/bootstrap.min.css" />

</head>
<body>
    <?php $vUserInfo->showUserInfo() ?>
    <nav>
        <?php $vnav->showNav() ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']) ?>
    </div>
    <!-- jQuery <3 ! -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../Js/bootstrap.min.js"></script>
</body>
>>>>>>> G3_S10_c
