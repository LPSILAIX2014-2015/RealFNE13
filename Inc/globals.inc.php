<?php
/*
* Ce fichier contient les variables globales qui seront utilisées sur toutes les pages du site ainsi que leur documentation.
* Pour chaque variable ajoutée veuillez indiquer son type, son utilisation, et dans le cas d'un objet ses attributs et méthodes
*/
session_start();
define('modeDebug',true);
define('LOGINFAIL_EXPIRE',600);
define('LOGINFAIL_ATTEMPTS',5);
define('LOGINFAIL_WARNING',5);
if (modeDebug) {
    error_reporting(E_ALL);
}
else {
    error_reporting(E_ERROR);
}
/*
 * Définition des reglages pour le blocage du compte après plusieurs echecs d'authentification
 * LOGINFAIL_EXPIRE : durée du blocage du compte (en secondes)
 * LOGINFAIL_ATTEMPTS : nombre d'echecs à l'authentification au bout duquel le compte est bloqué
 * LOGINFAIL_WARNING : nombre d'echecs au bout duquel une notification d'alerte est envoyée à l'administrateur.
 * Definir une valeur supérieure à LOGINFAIL_ATTEMPTS ou =0 si vous ne souhaitez pas déclencher cette notification
 */

/**/

global $page, $db, $user, $customAlert;
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
/*
 * array customAlert :
 * Tableau de messages d'alert customisés
 */
$customAlert = array();
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
