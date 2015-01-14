<?php
/*
* Ce fichier contient les variables globales qui seront utilisées sur toutes les pages du site ainsi que leur documentation.
* Pour chaque variable ajoutée veuillez indiquer son type, son utilisation, et dans le cas d'un objet ses attributs et méthodes
*/
session_start();
define('modeDebug',true);
global $page, $db, $user;
/*
* $page
* tableau contenant :
* [title] : le titre de la page
* [class] : la classe utilisée pour la construction de la page
* [method] : la méthode de cette classe appelée pour le traitement de la page
* [args] : les arguments à passer à la méthode
* [css] : chemin vers une feuille de style additionelle (optionnel)
*/
$page = array();//Titre, class "active";
/* $user
* objet CUser (Model/MUser.mod.php) - Classe représentant un utilisateur
* $user contient un CUser représentant l'utilisateur courant
* la classe CUser s'instancie en prennant 1 paramètre correspondant à au ID_USER de l'utilisateur dans la base.
*/
if ((testVar($_POST['login'])) && (testVar($_POST['password'])))  {
    //Si on reçoit un login et un mot de passe, on appelle la fonction connexion (Class/CConnexion.class.php) qui,
    //en cas de validation, crée un user et l'inscrit en session
    $connec = new CConnexion();
    $connec->connexion($_POST['login'],$_POST['password']);
}
elseif (testVar($_SESSION['ID_USER'])) {
    //Si l'ID_USER est enregistré en session on instancie dans $user avec la valeur enregistrée en session
    $user = new MUser($_SESSION['ID_USER']);
}
?>
