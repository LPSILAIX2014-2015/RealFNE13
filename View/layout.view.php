<?php
$vnav = new VNav();
$vUserInfo = new VUserInfo();
$vpage = new $page['class']();
global $connec, $customAlert;
$connec = new MDBase();
$vHtml = new VHtml();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $page['title']; ?></title>
    <link rel="stylesheet" href="./Css/main.css">
    <?php
    // Ajout feuille de style spécifique à cette page
    if (isset($page['css'])) {
        echo '<link rel="stylesheet" type="text/css" href="'.$page['css'].'" />' ;
    }
    ?>
    <link rel="icon" type="image/png" href="Img/favicon.png" />
    <script src="Lib/jquery.min.js"></script>
    <script src="./Js/form.js"></script>
    <script src="./Lib/jquery-ui.js"></script>
    <script src="./Lib/jquery.fancybox.pack.js"></script>
    <script src="./Lib/jquery.fancybox.js"></script>
    <script src="./Lib/jquery.form.js"></script>
    <script src="./Lib/jquery.validate.js"></script>
    <script src="./Lib/simplePagination.js"></script>
    <script src="./Js/recMP.js"></script>
    <link rel='stylesheet' href='./Lib/fullcalendar/fullcalendar.css' />
    <script src='./Lib/moments.js'></script>
    <script src='./Lib/fullcalendar/fullcalendar.js'></script>
    <script src='./Lib/fullcalendar/lang/fr.js'></script>
</head>
<body>
    <div class="bandeau">
        <a href="index.php?EX=home"><div class="logo">Accueil</div>
        <span class="sitetitle">La plate-forme<span class="subtitle">France Nature Environnement Bouches-du-Rhône</span>
        </a>

    </div>
    <?php
    /*
     * Affichage des icones de messages et notifications et du bouton Deconnexion si l'utilisateur est identifié
     */
    if(isset($user)) {
        $vHtml->showHtml('Html/usertopmenu.php');
    }
    ?>
    <nav>
        <?php $vnav->showNav() ?>
    </nav>
    <div class="page">
        <?php $vpage->$page['method']($page['arg']) ?>
    </div>
    <div class="leftcol">
        <?PHP
        $vHtml->showHtml('Html/recentarticles.php');

        $vHtml->showHtml('Html/linksnewsletters.php');
        ?>
    </div>
    <div class="rightcol">
        <?php
        if(!isset($user)) {
            $vHtml->showHtml('Html/loginForm.php');
        }
        else
        {
            $vHtml->showHtml('Html/userInfo.php');
        }
        $vHtml->showHtml('Html/nextevents.php');
        ?>
    </div>
    <div class="footer">
    	<a href="index.php?EX=legal">Informations légales</a>
    </div>
<?PHP
/*
 * @author <Julien Bénard>
 * Gestion des alertes customisées
 */
if (isset($customAlert)) {
    echo '<script>
    customAlerts = new Array();' ;
    foreach ($customAlert as $k => $a) {
        echo 'customAlerts['.$k.']=\''.addslashes($a).'\';';
    }
    echo '</script>';
    echo '<script src="Js/customAlert.js"></script>' ;
}
?>
    <script src="Js/createArticle.js"></script>
    <script src="Js/commentaire.js"></script>
    <div id="result"></div><!-- id="error"-->
    <div id="res"></div><!-- id="error" -->
</body>
