<?php

global $page;
$page = array();//Titre, class "active";
global $user;//Object Utilisateur (à completer)
global $db;
       $db = new DBase();

$statement = $db->prepare("SELECT * FROM USER");
?>