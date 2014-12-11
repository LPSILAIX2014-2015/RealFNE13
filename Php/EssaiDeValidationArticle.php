<?php
/**
 * Created by PhpStorm.
 * User: a11721385
 * Date: 27/11/14
 * Time: 11:46
 */

//if($_SESSION["ROLE"] != "MEMBRE" ){
//Si la session est valide
require_once("../Php/DBase.php");
  try{
      $connexionAvecPDO = new Dbase();

       //Connection réussie
       //$article_id=substr(); Id de la div


       $sql="UPDATE POST SET STATUS = 1 WHERE ID = " . $_POST["idd"];
       $connexionAvecPDO->exec($sql);


   }

   catch (PDOException $e) {
   echo 'Échec lors de la connexion : ' . $e->getMessage();

 }

//}

//else{
  //  print_r("ERREUR");
//}



