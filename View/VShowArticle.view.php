<?php
class VShowArticle
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showArticle($_html)
  {

    $connec = new MDBase();
    global $data_article;
    global $data_assoc;
    global $data_theme;

  	// AFFICHAGE
  	$state = $connec->prepare(
  	  "SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
              U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
  	   FROM   POST P, USER U
  	   WHERE  P.WRITER_ID = U.ID
         AND  P.PTYPE = 'ARTICLE'
  	   ORDER BY id DESC"
  	);
  	$state->execute();
  	$data_article = $state->fetchAll(PDO::FETCH_ASSOC);

    $data_assoc = $connec->getAllAssocs();
    $data_theme = $connec->getAllThemes();

  	// REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);

  } // showShowArticle($_html)
  
} // VHtml
?>
