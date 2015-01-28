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
    
    // SYSTEME DE PAGINATION

    //$messagesParPage=15;
    $messagesParPage=2; // pour test


    $retour_total = $connec->query("SELECT COUNT(*) AS TOTAL FROM POST");
    $donnees_total = $retour_total->fetchAll(PDO::FETCH_ASSOC);
    $total = $donnees_total[0]['TOTAL'];

    $nombreDePages=ceil($total/$messagesParPage);

    if(isset($_GET['page'])) {
      $pageAtuelle=intval($_GET['page']);

      if($pageAtuelle > $nombreDePages) {
        $pageAtuelle=$nombreDePages;
      }
    } else {
      $pageAtuelle=1;
    }

    $premiereEntree=($pageAtuelle-1)*$messagesParPage;

    // AFFICHAGE

    $state = $connec->prepare(
      "SELECT P.*, U.NAME, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE 
       FROM post P, user U
       WHERE P.WRITER_ID = U.ID
       ORDER BY id DESC
       LIMIT " . $premiereEntree . ", " . $messagesParPage . " "
    );
    $state->execute();
    $data_article = $state->fetchAll(PDO::FETCH_ASSOC);


    echo '<div class="container-fluid pvarticle">';
    echo '<h1>Liste des articles</h1>';

      for($i = 0 ; $i < count($data_article) ; ++$i)
      {
        echo "<div id='article" . $data_article[$i]['ID']
                    . "' class='lienarticle'>";
          echo "<div id='imgplace'>";
            echo "<img src='" . $data_article[$i]['IMAGEPATH']
                    . "' class='img-responsive' />";
          echo "</div>";
        
          echo "<div id='infoarticle'>";
            echo "<h2>" . $data_article[$i]['TITLE'] . "</h2>";
            echo "<p class='auteur'>"
                    . $data_article[$i]['NAME']
                    . " ". $data_article[$i]['SURNAME']
                    . ", le ". $data_article[$i]['PDATE']
                    . "</p>";
            echo "<p class='description'>"
                    . $data_article[$i]['DESCRIPTION']
                    . "</p>";
          echo "</div>";
        echo "</div>";
      }
    echo "</div>";

    // LISTE DES PAGES
    echo "<p class='text-center'>Page : ";
      for ($i=1; $i <= $nombreDePages; ++$i) {
        if($i==$pageAtuelle) {
          echo $i;
        } else {
          /*if(intval($i)<1) {

          } else {*/
            echo '<a href="index.php?EX=showArticle&page='.$i.'"> '. $i .' </a>';
 //         }
        }
      }
    echo "</p>";


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);

  } // showShowArticle($_html)
  
} // VHtml
?>