<?php
require('../Inc/require.inc.php');
require('../Inc/globals.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';


switch($EX)
{
	case 'home'      : home();       break;
	case 'login'     : login();      break;
    case 'reportList': reportList(); break;
	default : error();
}


require('../View/layout.view.php');


function home()
{
	global $page;
	$page['title'] = 'TEST';
	$page['class'] = 'VHome';
	$page['method'] = 'showHome';
	$page['arg'] = '../Html/accueil.php';
}

function error()
{
	global $page;
	$page['title'] = 'Erreur 404 !';
	$page['class'] = 'VHtml';
	$page['method'] = 'showHtml';
	$page['arg'] = '../Html/unknown.php';
}

function login()
{
    global $page;
    $page['title'] = 'Erreur 404 !';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = '../Html/unknown.php';
}

function reportList()
{
    global $page;
    $page['title'] = 'Liste des rapports';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = '../Html/reportlist.php';
}
?>

