<?php
/*
 * Ce fichier contient les variables globales qui seront utilisées sur toutes les pages du site ainsi que leur documentation.
 * Pour chaque variable ajoutée veuillez indiquer son type, son utilisation, et dans le cas d'un objet ses attributs et méthodes
 */
global $page;
$page = array();//Titre, class "active";
/*
 * $page
 * tableau contenant :
 * [title] : le titre de la page
 * [class] : la classe utilisée pour la construction de la page
 * [method] : la méthode de cette classe appelée pour le traitement de la page
 * [args] : les arguments à passer à la méthode
 */
/*
 *  $db
 * objet PDO contenant la connexion à la base de données
 * */
global $db ;
//$db = new DBase() ;

global $user;
/*
 * Object Utilisateur (à completer)
 */


?>