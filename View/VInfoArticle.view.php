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
    $id = $_GET['id'];
    var_dump($id);
    $state = $connec->prepare(
      "SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
              U.NAME AUTHOR_NAME, U.SURNAME AUTHOR_SURNAME
       FROM   POST P, USER U
       WHERE  P.WRITER_ID = U.ID
         AND  P.ID = :id"
  	);
    $state->bindValue('id', $id, PDO::PARAM_INT);
    $state->execute();
    $article = $state->fetchAll(PDO::FETCH_ASSOC);


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);
    
  } // showInfoArticle($_html)
  
} // VHtml
?>