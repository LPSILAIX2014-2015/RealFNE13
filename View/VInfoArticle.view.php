<?php
class VInfoArticle
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showInfoArticle($_html)
  {
    global $connec;
  	global $article;

    $state = $connec->prepare(
      "SELECT POST.*, USER.NAME AUTHOR_NAME, USER.SURNAME AUTHOR_SURNAME
  		 FROM   POST, USER
  		 WHERE  POST.WRITER_ID = USER.ID"
  	);
    $state->execute();
    $article = $state->fetchAll(PDO::FETCH_ASSOC);


    /* AFFICHAGE */

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);
    
  } // showInfoArticle($_html)
  
} // VHtml
?>