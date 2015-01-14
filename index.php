<?php
require('Inc/require.inc.php');
require('Inc/globals.inc.php');
require('Php/DBase.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';

switch($EX)
{
	case 'home'      : home();       break;
	case 'login'     : login();      break;
    case 'reportList': reportList(); break;
    case 'deconnexion' :
        if (isset($_POST['login']) && isset($_POST['password']))
        {
            home();
        }
        else
        {
            deconnexion();
        }
        break;
	case 'consultMessages' : consultMessages(); break;
    case 'createArticle':   createArticle(); break;

    case 'showArticle'		: showArticle(); 	 break;
    case 'showInfoArticle'	: showInfoArticle(); break;

    case 'formCreateArticle' : formCreateArticle(); break;

	default : error();
}

require('View/layout.view.php');

function home()
{
	global $page;
	$page['title'] = 'Test';
	$page['class'] = 'VHome';
	$page['method'] = 'showHome';
	$page['arg'] = 'Html/accueil.php';
}

function error()
{
    global $page;
	$page['title'] = 'Erreur 404 !';
	$page['class'] = 'VHtml';
	$page['method'] = 'showHtml';
	$page['arg'] = 'Html/unknown.php';
}

function reportList()
{
    global $page;
    $page['title'] = 'Liste des rapports';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/reportlist.php';
}

function createArticle()
{
    global $page;
    $page['title'] = 'écrire un article';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/createArticle.php';
}

function formCreateArticle()
{
    $formCreateArticle = new MFormCreateArticle();
    $formCreateArticle->insertDB($_POST);
}

function consultMessages()
{
    global $page;
    $page['title'] = 'Liste des messages';
    $page['class'] = 'VConsultMessages';
    $page['method'] = 'showConsultMessages';
    $page['arg'] = 'Html/consultMessages.php';
}


function showArticle()
{
    global $page;
    $page['title'] = 'Liste des articles';
    $page['class'] = 'VShowArticle';
    $page['method'] = 'showArticle';
    $page['arg'] = 'Html/showArticle.php';
}

function showInfoArticle()
{
    global $page;
    $page['title'] = 'Détail';
    $page['class'] = 'VInfoArticle';
    $page['method'] = 'showInfoArticle';
    $page['arg'] = 'Html/infoArticle.php';
}

function deconnexion()
{
    global $page;
    unset($_SESSION['ID_USER']);
    unset($GLOBALS['user']);
    session_destroy();
    $page['title'] = 'Retour après déco';
    $page['class'] = 'VHome';
    $page['method'] = 'showHome';
    $page['arg'] = 'Html/accueil.php';
}

?>
