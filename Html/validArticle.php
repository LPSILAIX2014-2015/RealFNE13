<?php

if ((isset($_SESSION)) && ($_SESSION['ROLE'] != 'MEMBRE'))
{

    global $data_article;
    global $connec;


// AFFICHAGE

$state = $connec->prepare(
    "SELECT P.*, U.NAME, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
     FROM POST P, USER U
     WHERE P.WRITER_ID = U.ID AND P.STATUS=0
     ORDER BY id DESC"
);
$state->execute();
$data_article = $state->fetchAll(PDO::FETCH_ASSOC); //Récupération des articles
?>

<div class="container-fluid pvarticle">
    <h1>Liste des articles</h1>
    <?php
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

        echo "<input class='butt_valid' id='valid_". $data_article[$i]['ID']."' type='submit' value='Validation'>";
        echo "<input class='butt_suppr' id='valid_". $data_article[$i]['ID']."' type='submit' value='Suppression'>";
    }
    ?>

</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>
<script type="text/javascript" src="Js/jqueryValidationArticle.js"></script>

<?php } else require('../index.php') ?>

