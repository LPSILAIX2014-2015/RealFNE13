<?php
require('Inc/require.inc.php');
require('Inc/globals.inc.php');
$EX = isset($_REQUEST['EX']) ? $_REQUEST['EX'] : 'home';
if(isset($_REQUEST['idPrev'])){
    $idPrev= $_REQUEST['idPrev'];
    $idNext= $_REQUEST['idNext'];
}

switch($EX)
{
	case 'home'      : home();       break;
	case 'login'     : login();      break;
    case 'reportList': reportList(); break;
    case 'searchMember'     : searchMember();      break;
    case 'manageMembers': manageMembers(); break;
    case 'createMember': createMember(); break;
    case 'createUser': createUser(); break;
    case 'updateMember': updateMember(); break;
    case 'deleteMember': deleteMember(); break;
    case 'insert'    : insert();     exit; // Mèthode insert() pour enregistrer le changement de mot de passe
    case 'mailconf'  : mailconf();   exit; // Mèthode pour envoyer l'email de confirmation
    case 'recup'     : recuperation(); break; // Presentation de la vue
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
    case 'formCreateArticle' : formCreateArticle(); break;
    case 'updateAsso' : updateAsso(); break;
    case 'updateAdminAsso': updateAdminAsso(); break;
    case 'swapRoles': swapRoles($idPrev,$idNext); break;
    case 'createAsso' : createAsso(); break;
    case 'createAdmin' : createAdmin(); break;
    case 'creationAdmin' : creationAdmin(); break;
    case 'searchAsso'  : searchAsso();      break;
    case 'manageAsso': manageAsso(); break;
    default : check($EX);
}

require('./View/layout.view.php');

function check($EX)
{
    require('Class/CRecMP.class.php'); // Appele à les mèthodes de la classe pour verifier les données dans la BD
    global $eml; // Variable global pour afficher le mail dans le deuxième formilaire (où l'user changera son mot de passe)
    $dbverf = new CRecMP(); // Instantiation de la Classe CRecMP
    $value = $dbverf->selectMD5($EX); // Verification de la chaine de l'URL
    if(count($value)==0){ // Si le resultat du request est 0 montre la page d'erreur
            error();
    }else{ // Sinon s'affichera le mail dans le formulaire de changement 
        $var = $dbverf->searchMail($EX);
        $eml = $var[0]["MAIL"];
        rec(); // Formilaire de changement 
    }
}

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
    $page['css'] = 'reportList.css';
    $page['arg'] = 'Html/reportlist.php';
}

    function formCreateArticle()
    {
        $formCreateArticle = new MFormCreateArticle();
        $formCreateArticle->insertDB($_POST);
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

    function recuperation() // Presentation du formilaire principal pour envoyer le mail
    {
        global $page;
        $page['title'] = 'Recuperation du Mot de passe';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['css'] = 'Css/recupMdp.css';
        $page['arg'] = 'Html/recMail.php';
    }
    function rec() // Deuxième fourmulaire pour changer le mot de passe
    {
        global $page;
        $page['title'] = 'Recuperation du Mot de passe';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/recuperation.php';
    }

    function insert() // Mèthode pour enregistrer les données
    {
        session_start(); //
        if($_POST['iCaptcha']!=$_SESSION['captcha']){ // Verification si l'input est égal la variable de session
            echo "<script languaje='javascript'>insertE();</script>"; // Affichage d'un message d'erreur
        }else{
            $dbverf = new CRecMP($_POST['mail']); // Verification pour tester l'email
            $value = $dbverf->selectMail();

            if(count($value)==0){// si l'email n'existe pas dans la BD s'affichera un message d'erreur
                echo "<script languaje='javascript'>mailMod();</script>";
            }else{ // Cas contraire
                $update = $dbverf->updateMotPasse($_POST); // Mise en jour Mot de passe
                $dbverf->updateRSB(); // Effacer le contenu de l'attribute dnas la BD
                $dbverf->sendMail(); // l'envoi de mail de confirmation
                echo $update;
            }
        }
    }
    function mailconf()
    {
        $dbverf = new CRecMP($_POST['mail']);
        $value = $dbverf->selectMail(); // Verification de mail dans le formulaire 'recMail'

        if(count($value)==0){ // Affichage d'un message d'erreur si le mail n'existe pas
            echo "<script languaje='javascript'>mailErr();</script>";
        }else{ // Si le mail existe, s'envoyera un mail avec le lien pour changer son mot de passe
            $update = $dbverf->sendMailConf();
            echo $update;
        }
    }

    function consultMessages()
    {
        global $page;
        $page['title'] = 'Liste des messages';
        $page['class'] = 'VConsultMessages';
        $page['method'] = 'showConsultMessages';
        $page['arg'] = 'Html/consultMessages.php';
    }

    function createArticle()
    {
        global $page;
        $page['title'] = 'écrire un article';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['css'] = 'Css/createArticle.css';
        $page['arg'] = 'Html/createArticle.php';
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

    function writeMessages()
    {
        global $page;
        $page['title'] = "Ecriture d'un message";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/formulaireMessage.html';
    }
    
    function updateAsso()
    {
        global $page;   
        $page['title'] = "Modif d'une association";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/updateAsso.php';
    }

    function updateAdminAsso()
    {
        global $page;
        $page['title'] = "Changement de gérant  ";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/updateAdminAsso.php';
    }

    function createAsso()
    {
        global $page;   
        $page['title'] = "Création d'une association";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/createAsso.php';
    }

    function createUser()
    {
        include('Php/create.php');
    }

    function createAdmin()
    {
        global $page;   
        $page['title'] = "Création d'un administrateur d'association";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/createAdmin.php';
    }

    function creationAdmin()
    {
        include('./Php/createAdmin.php');
    }
    function swapRoles($idPrev, $idNext){
        global $page;
        (new Muser($idPrev))->setRole('MEMBRE');
        (new Muser($idNext))->setRole('ADMIN');
        $page['title'] = 'Test';
        $page['class'] = 'VHome';
        $page['method'] = 'showHome';
        $page['arg'] = 'Html/accueil.php';
    }

    function searchAsso()
    {
        global $page;
        $page['title'] = 'Recherche d\'association';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/searchAsso.php';
    }

    function manageAsso()
    {
        global $page;
        $page['title'] = 'Gestion des associations';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/manageAsso.php';
    }


?>
