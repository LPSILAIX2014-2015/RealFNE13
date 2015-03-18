<?php
class VInfoCalendar
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showInfoCalendar($_html)
  {
    
	  global $connec;
  	global $event;


    // AFFICHAGE
    $id = $_GET['id'];
    $state = $connec->prepare(

         "SELECT TITLE, PDATE 
           FROM POST
           WHERE DATE-BEGIN is not null"
  	);
    $state->bindValue('id', $id, PDO::PARAM_INT);
    $state->execute();
    $event = $state->fetchAll(PDO::FETCH_ASSOC);


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);
    
  } // showInfoCalendar($_html)
  
} // VHtml
?>