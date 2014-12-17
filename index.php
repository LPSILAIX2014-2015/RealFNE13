<?php
require('Inc/require.inc.php');
require('Inc/globals.inc.php');

$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';


switch($EX)
{
	case 'home'      : home();       break;
	case 'login'     : login();      break;
    case 'reportList': reportList(); break;
    case 'searchMember'     : searchMember();      break;
    case 'manageMembers': manageMembers(); break;
    case 'createMember': createMember(); break;
    case 'updateMember': updateMember(); break;
    case 'deleteMember': deleteMember(); break;
	default : error();
}

require('./View/layout.view.php');


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

function searchMember()
{
    global $page;
    $page['title'] = 'Recherche de membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/searchMember.php';
}

function manageMembers()
{
    global $page;
    $page['title'] = 'Gestion des membres';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/manageMembers.php';
}

function createMember()
{
    global $page;
    $page['title'] = 'Creation d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/create.php';
}

function updateMember()
{
    global $page;
    $page['title'] = 'Modification d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/update.php';
}

function deleteMember()
{
    global $page;
    $page['title'] = 'Supression d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/delete.php';
}
?>

