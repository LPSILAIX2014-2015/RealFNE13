<?php
class VShowArticle
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showArticle($_html)
  {
    //Simulation de marchage
    //$idUser = $_SESSION['idUser'];
    $idUser = 1;

    global $connec;
    global $data_article;


    // AFFICHAGE

    $state = $connec->prepare(
      "SELECT P.*, U.NAME, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE 
       FROM POST P, USER U
       WHERE P.WRITER_ID = U.ID
       ORDER BY id DESC"
    );
    $state->execute();
    $data_article = $state->fetchAll(PDO::FETCH_ASSOC);


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);

  } // showShowArticle($_html)
  
} // VHtml
?>
