<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'on');
header ('Content-Type: text/html; charset=utf-8');
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
    case 'cloud'      : cloud();       break;
    case 'downloadCloud'      : downloadCloud();       break;
    case 'addFile'      : addFile();       break;
    case 'login'     : login();      break;
    case 'reportList': reportList(); break;
    case 'searchMember'     : searchMember();      break;
    case 'manageMembers': manageMembers(); break;
    case 'createMember': createMember(); break;
    case 'createUser': createUser(); break;
    case 'updateMember': updateMember(); break;
    case 'updateAMember': updateAMember(); break;
    case 'deleteMember': deleteMember(); break;
    case 'deleteAMember': deleteAMember(); break;
    case 'insert'    : insert();     exit; // Mèthode insert() pour enregistrer le changement de mot de passe
    case 'changePass': changePass(); exit; // Mèthode changePass() pour enregistrer le changement de mot de passe
    case 'mailconf'  : mailconf();   exit; // Mèthode pour envoyer l'email de confirmation
    case 'maillog'   : maillog();    exit;
    case 'chImg'     : chImg();    exit; // Changer l'image du profil
    case 'recup'     : recuperation(); break; // Presentation de la vue
    case 'allNews'     : allNews(); break; // All Newsletter
    case 'genNL'     : genNL();    exit; // Newsletter
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
    case 'writeMessages' : writeMessages(); break;
    case 'consultMessages' : consultMessages(); break;
	case 'sendMessage' : sendMessage(); break;
    case 'endMessages' : endMessages(); break;
    case 'createArticle':   createArticle(); break;
    case 'calendar'     :   calendar();break;
    case 'showArticle'      : showArticle();     break;
    case 'showInfoArticle'  : showInfoArticle(); break;
    case 'formCreateArticle' : formCreateArticle(); break;
    case 'updateAsso' : updateAsso(); break;
    case 'updateAdminAsso': updateAdminAsso(); break;
    case 'swapRoles': swapRoles($idPrev,$idNext); break;
    case 'updateRole': updateRole(); break;
    case 'createAsso' : createAsso(); break;
    case 'createAdmin' : createAdmin(); break;
    case 'creationAdmin' : creationAdmin(); break;
    case 'manageAsso': manageAsso(); break;
    case 'deleteAsso'  : deleteAsso();      break;
    case 'profil'    : profil(); break; // Affichage du profil
    case 'legal' : legal(); break;
    case 'validArticle' : validArticle(); break;
    case 'updateMail' : updateMail(); break;
    case 'downloadCVS' : downloadCVS(); break;
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
        rec(); // Formulaire de changement
    }
}
function login(){
    $lo = new CConnexion();
    $value = $lo->connexion($_POST['login'], $_POST['password']);
}
function home()
{
    global $page;
    $page['title'] = 'Accueil';
    $page['class'] = 'VHome';
    $page['method'] = 'showHome';
    $page['arg'] = 'Html/accueil.php';
    $page['css'] = 'Css/accueil.css';
}
function cloud()
{
    global $page;
    $page['title'] = 'Cloud';
    $page['class'] = 'VCloud';
    $page['method'] = 'showCloud';
    $page['arg'] = 'Html/cloud.php';
    $page['css'] = 'Css/cloud.css';
}
function downloadCloud()
{
    $mDownloadCloud = new MDownloadCloud();
    $mDownloadCloud->download(htmlspecialchars($_GET['id']));
    header('Location: index.php?EX=cloud');
}
function addFile()
{
    $mAddFile = new MAddFile();
    $result = $mAddFile->addFile($_FILES);

    if($result == "OK")
    {
        header('Location: index.php?EX=cloud&state='.$result);
    }
    elseif ($result == "ERR_SIZE")
    {
        header('Location: index.php?EX=cloud&state='.$result);
    }
    elseif ($result == "ERR_NC")
    {
        header('Location: index.php?EX=cloud&state='.$result);
    }
    else
    {
        header('Location: index.php?EX=cloud&state=ERR_UNKNOWN');
    }
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
    $page['css'] = 'Css/reportList.css';
    $page['arg'] = 'Html/reportlist.php';
}
function formCreateArticle()
{
    $formCreateArticle = new MFormCreateArticle();
    $nextId = $formCreateArticle->insertDB($_POST);
    var_dump($nextId);
    $jsonDecoded = json_decode($nextId,true);
    if($jsonDecoded["lastID"] == 0){  //S'il y a une erreur
        $url = 'Location: index.php?EX=createArticle&state='.$jsonDecoded["error"];
        header($url);
    }else{
        $url = 'Location: index.php?EX=showInfoArticle&id='.$jsonDecoded["lastID"];
        header($url);
    }
}
function searchMember()
{
    global $page;
    $page['title'] = 'Recherche de membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['css'] = 'Css/search.css';
    $page['arg'] = 'Html/searchMember.php';
}
function manageMembers()
{
    global $page;
    $page['title'] = 'Gestion des membres';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['css'] = 'Css/search.css';
    $page['arg'] = 'Html/manageMembers.php';
}
function showArticle()
{
    global $page;
    $page['title'] = 'Liste des articles';
    $page['class'] = 'VShowArticle';
    $page['method'] = 'showArticle';
    $page['css'] = 'Css/showArticle.css';
    $page['arg'] = 'Html/showArticle.php';
}
function showInfoArticle()
{
    global $page;
    $page['title'] = 'Détail';
    $page['class'] = 'VInfoArticle';
    $page['method'] = 'showInfoArticle';
    $page['css'] = 'Css/showArticle.css';
    $page['arg'] = 'Html/infoArticle.php';
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

function updateAMember()
{
    global $page;
    $page['title'] = 'Modification d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Php/update.php';
}

function deleteMember()
{
    global $page;
    $page['title'] = 'Suppression d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/delete.php';
}

function deleteAMember()
{
    global $page;
    $page['title'] = 'Suppression d\'un membre';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Php/delete.php';
}

    function recuperation() // Presentation du formilaire principal pour envoyer le mail

    {
        global $page, $user;
        if (isset($user)) { // Validation pour l'envoi du mail
            echo "<script>location.href='index.php';</script>";
        }else{
            $page['title'] = 'Recuperation du Mot de passe';
            $page['class'] = 'VHtml';
            $page['method'] = 'showHtml';
            $page['css'] = 'Css/recupMdp.css';
            $page['arg'] = 'Html/recMail.php';
        }
    }
    function rec() // Deuxième fourmulaire pour changer le mot de passe
    {
        global $page;
        $page['title'] = 'Recuperation du Mot de passe';
        $page['class'] = 'VHtml';
        $page['css'] = 'Css/recupMdp.css';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/recuperation.php';
    }
    function changePass() // Mèthode pour enregistrer les données
    {
        global $user;
        if (!isset($user)) { // Validation pour l'envoi du mail
            echo "<script>location.href='index.php';</script>";
        }else{
            if($_POST['iCaptcha']!=$_SESSION['captcha']){ // Verification si l'input est égal la variable de session
                echo "<script languaje='javascript'>insertCH();</script>"; // Affichage d'un message d'erreur
            }else{
                $dbverf = new CRecMP($GLOBALS['user']->getMail()); // Verification pour tester l'email
                $value = $dbverf->selectPassword($GLOBALS['user']->getId());
                if($value['PASSWORD']!=md5($_POST['act_pass'])){
                    echo "<script languaje='javascript'>errorCH();</script>";
                }else{
                    $update = $dbverf->updatePassLog($_POST, $GLOBALS['user']->getId()); // Mise en jour Mot de passe
                    $dbverf->sendMail(); // l'envoi de mail de confirmation
                    echo $update;
                }

            }
        }
    }
    function insert() // Mèthode pour enregistrer les données
    {
        //session_start(); //
        if($_POST['iCaptcha']!=$_SESSION['captcha']){ // Verification si l'input est égal la variable de session
            echo "<script languaje='javascript'>insertE();</script>"; // Affichage d'un message d'erreur
        }else{
            $dbverf = new CRecMP($_POST['mail']); // Verification pour tester l'email
            $value = $dbverf->selectMail();
            if(count($value)==0){// si l'email n'existe pas dans la BD s'affichera un message d'erreur
                echo "<script languaje='javascript'>mailMod();</script>";
            }else{ // Cas contraire
                $update = $dbverf->updatePassword($_POST); // Mise en jour Mot de passe
                $dbverf->updateRSB(); // Effacer le contenu de l'attribute dnas la BD
                $dbverf->sendMail(); // l'envoi de mail de confirmation
                echo $update;
            }
        }
    }

    function chImg()
    {
        global $user;
        if (!isset($user)) { // Validation pour l'envoi du mail
            echo "<script>location.href='index.php';</script>";
        } else {
            //  Nous vérifions la requete AJAX
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            {
                $file = $_FILES['sel_img']['name']; // Nous obtenons le name du fichier
                if(!is_dir("Photos/")){ // Si le dossier n'existe pas, nous créons le dossier
                    mkdir("Photos/", 0777);
                }
                if ($file && move_uploaded_file($_FILES['sel_img']['tmp_name'],"Photos/".$file)) // Verification de téléchargement correcte
                {
                   sleep(3);//retrasamos la petición 3 segundos
                   unlink($GLOBALS['user']->getPhotopath());
                   $dbchI = new MUser($GLOBALS['user']->getId());
                   $dbchI->setPhotopath("Photos/".$file);
                }
            }else{
                throw new Exception("Error Processing Request", 1);
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
    function maillog()
    {
        global $user;
        if (!isset($user)) { // Validation pour l'envoi du mail
            echo "<script>location.href='index.php';</script>";
        } else {
            $dbverf = new CRecMP($GLOBALS['user']->getMail());
            $value = $dbverf->selectMail(); // Verification de mail dans le formulaire
            if(count($value)==0){ // Affichage d'un message d'erreur si le mail n'existe pas
                echo "<script languaje='javascript'>mailErr();</script>";
            }else{ // Si le mail existe, s'envoyera un mail avec le lien pour changer son mot de passe
                echo "<script>mailErr();</script>";
                $update = $dbverf->sendMailConf();
                header('Location: index.php');
            }
        }
    }
    function consultMessages()
    {
        global $page;
        $page['title'] = 'Liste des messages';
        $page['class'] = 'VConsultMessages';
        $page['method'] = 'showConsultMessages';
        $page['css'] = 'Css/tableMessages.css';
        $page['arg'] = 'Html/consultMessages.php';
    }
    function writeMessages()
    {
        global $page;
        $page['title'] = "Ecriture d'un message";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/formulaireMessage.php';
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

    function profil(){ // Presentation du profil
        global $user;
        if (!isset($user)) { // S'il n'y a pas une session ouverte n'affichera rien
            echo "<script>location.href='index.php';</script>";
        } else {
            global $page;
            $page['title'] = 'Mon profil';
            $page['class'] = 'VHtml';
            $page['method'] = 'showHtml';
            //$page['css'] = 'Css/recupMdp.css';
            $page['css'] = 'Css/profil.css';
            $page['arg'] = 'Html/profil.php';
        }

    }
    function createAdmin()
    {
        global $page;
        $page['title'] = "Création d'un administrateur d'association";
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/createAdmin.php';
    }
    function legal() {
        global $page;
        $page['title'] = 'Mentions légales' ;
        $page['class'] = 'VHtml' ;
        $page['method'] = 'showHtml' ;
        $page['arg'] = 'Html/legal.html' ;
    }
    function creationAdmin()
    {
        include('./Php/createAdmin.php');
    }
    function swapRoles($idPrev, $idNext){
        global $page;
        $a = new MUser($idPrev);
        $a->setRole('MEMBRE');
        $a = new MUser ($idNext);
        $a->setRole('ADMIN');
        $page['title'] = 'Accueil';
        $page['class'] = 'VHome';
        $page['method'] = 'showHome';
        $page['arg'] = 'Html/manageAsso.php';
    }

    function updateRole()
    {
        global $page;
        $page['title'] = 'Modification d\'un membre';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Php/updateRole.php';
    }

    function manageAsso()
    {
        global $page;
        $page['title'] = 'Gestion des associations';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['css'] = 'Css/search.css';
        $page['arg'] = 'Html/manageAsso.php';
    }
    function deleteAsso()
    {
        global $page;
        $page['title'] = 'Suppression d\'une association';
        $page['class'] = 'VHtml';
        $page['method'] = 'showHtml';
        $page['arg'] = 'Html/deleteAsso.php';
    }
function createArticle()
{
    global $page;
    $page['title'] = 'Ecrire un article';
    $page['class'] = 'VCreateArticle';
    $page['method'] = 'showCreateArticle';
    $page['css'] = 'Css/createArticle.css';
    $page['arg'] = 'Html/createArticle.php';
}
function deconnexion()
{
    global $page;
    unset($_SESSION['ID_USER']);
    unset($GLOBALS['user']);
    session_destroy();
    $page['title'] = 'Accueil';
    $page['class'] = 'VHome';
    $page['method'] = 'showHome';
    $page['css'] = 'Css/accueil.css';
    $page['arg'] = 'Html/accueil.php';
}
function calendar()
{
    global $page;
    $page['title'] = 'Agenda';
    $page['class'] = 'VCalendar';
    $page['method'] = 'showCalendar';
    $page['arg'] = 'Html/calendar.php';
    $page['css'] = 'Lib/fullcalendar/fullcalendar.css';
}

function sendMessage()
{
    global $page;
    $page['title'] = "Envoi à d'autres destinataires ?";
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/envoiDestinataires.php';
}
function endMessages()
{
    global $page;
    $page['title'] = 'Message transmis';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/finEnvoi.php';
}

function validArticle()
{
    global $page;
    $page['title'] = "Validation d'article ";
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/validArticle.php';
    $page['css'] = 'Css/showArticle.css';
}

function updateMail()
{
    global $page;
    $page['title'] = 'Creation de profil';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/update-mail.php';
}

function downloadCVS()
{
    $mDownloadCsv = new MDownloadCsv();
    $mDownloadCsv->download();
}

function genNL(){
    if ($_GET['data']=='') {
        header('Location: index.php');
    } else {
        $pdf = new MGenNewL();
        $pdf->setDate($_GET);
        $pdf->generate();
    }
}
function allNews()
{
    global $page;
    $page['title'] = 'Toutes les Newsletters';
    $page['class'] = 'VHtml';
    $page['method'] = 'showHtml';
    $page['arg'] = 'Html/allNews.php';
    $page['css'] = 'Css/newsLetter.css';
}
?>
