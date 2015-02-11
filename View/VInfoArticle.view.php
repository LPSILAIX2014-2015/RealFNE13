<?php
class VInfoArticle
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showInfoArticle($_html)
  {
    
	  global $connec;
  	global $article;


    // AFFICHAGE

    $state = $connec->prepare(
      "SELECT P.*, U.NAME AUTHOR_NAME, U.SURNAME AUTHOR_SURNAME
       FROM   POST P, USER U
       WHERE  P.WRITER_ID = U.ID"
  	);
    $state->execute();
    $article = $state->fetchAll(PDO::FETCH_ASSOC);


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);
    
  } // showInfoArticle($_html)
  
} // VHtml
?>