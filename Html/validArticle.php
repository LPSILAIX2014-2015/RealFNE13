<?php

//SADMIN//
if ((isset($_SESSION)) && ($_SESSION['ROLE'] == 'SADMIN'))
{
    global $data_assoc;
    global $data_article;
    global $connec;



// Préparation de la requête sql de sélection des articles

$state = $connec->prepare(
    "SELECT P.*, P.PTYPE, U.NAME, U.ASSOCIATION_ID, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
     FROM POST P, USER U
     WHERE P.WRITER_ID = U.ID AND (P.STATUS=0 OR P.STATUS=1) AND P.PTYPE='ARTICLE'
     ORDER BY ID DESC"
);

$state->execute();
$data_article = $state->fetchAll(PDO::FETCH_ASSOC); //Récupération des articles
?>

    <!-- INSTALLATION DE LA MISE EN PAGE -->

    <div class="container-fluid pvarticle">
        <div class="filter">

            <select id="filterVALID">
                <option value="0">- En attente de validation -</option>
                <option value="1">- Validé</option>
            </select>

        </div>

        <h1>Liste des articles</h1>

        <?php

   //Affichage des articles

    for($i = 0 ; $i < count($data_article) ; ++$i)
    {

        //Remplacement des balises dans l'article par du texte

        if(strlen($data_article[$i]['CONTENT']) > 250) {
            $contenuDecode = html_entity_decode($data_article[$i]['CONTENT']);

            $contenuDecode = str_replace('<br />', '[SLaaa]', $contenuDecode);
            $contenuDecode = str_replace('</p>', '[SLaaa]', $contenuDecode);
            $contenuTrunc = substr(strip_tags($contenuDecode), 0, 250);
            $contenuFormate = str_replace('[SLaaa]', '<br />', $contenuTrunc);

            $description = $contenuFormate;
        } else {
            $description = html_entity_decode($data_article[$i]['CONTENT']);
        }

        //Si l'article n'est pas encore validé

            if($data_article[$i]['STATUS'] == 0)
            {

                echo "<div id='article" . $data_article[$i]['ID']
                    . "' class='lienarticle '"

                    .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                    .       "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
            echo "<div id='imgplace'>";
            echo "<img src='" . $data_article[$i]['IMAGEPATH']
                . "' class='img-responsive' " . "'>";

            echo "</div>";

            echo "<div id='infoarticle'>";
            echo "<h2>" . $data_article[$i]['TITLE'] . "</h2>";
            echo "<p class='auteur'>"
                . $data_article[$i]['NAME']
                . " ". $data_article[$i]['SURNAME']
                . ", le ". $data_article[$i]['PDATE']
                . "</p>";
            echo "<p class='description'>"
                . $description
                . "</p>";
            echo "</div>";


                echo "</div>";

                echo "<input class='butt_valid' var='".$data_article[$i]['ID']."' type='submit' value='Validation'>";
                echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

            }

            //Artcile validé

        else if($data_article[$i]['STATUS'] == 1)
        {
            echo "<div id='article" . $data_article[$i]['ID']
                . "' class='lienarticle '"

                .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                .       "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
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
                . $description
                . "</p>";
            echo "</div>";

            echo "</div>";


            echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

        }


    }
    ?>

</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>
<script type="text/javascript" src="Js/jqueryValidationArticle.js"></script>

<?php }

    //ADMIN OU VALIDATOR

else if ( (isset($_SESSION)) && ( ($_SESSION['ROLE'] == 'ADMIN') || ($_SESSION['ROLE'] == 'VALIDATOR')) )
{
    global $data_assoc;
    global $data_article;
    global $connec;

// // Préparation de la requête sql de sélection des articles

$state = $connec->prepare(
    "SELECT P.*, P.PTYPE, U.NAME, U.ASSOCIATION_ID, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
     FROM POST P, USER U
     WHERE P.WRITER_ID = U.ID AND (P.STATUS=0 OR P.STATUS=1) AND P.PTYPE='ARTICLE'
     ORDER BY ID DESC"
);
$state->execute();
$data_article = $state->fetchAll(PDO::FETCH_ASSOC); //Récupération des articles
?>


    <!-- Préparation de l'affichage -->

<div class="container-fluid pvarticle">

    <div class="filter">
    <select id="filterVALID">
        <option value="0">- En attente de validation -</option>
        <option value="1">- Validé</option>
    </select>
</div>

    <h1>Liste des articles</h1>
    <?php



    for($i = 0 ; $i < count($data_article) ; ++$i)
    {
        //Remplacement des balises dans l'article par du texte

        if(strlen($data_article[$i]['CONTENT']) > 250) {
            $contenuDecode = html_entity_decode($data_article[$i]['CONTENT']);

            $contenuDecode = str_replace('<br />', '[SLaaa]', $contenuDecode);
            $contenuDecode = str_replace('</p>', '[SLaaa]', $contenuDecode);
            $contenuTrunc = substr(strip_tags($contenuDecode), 0, 250);
            $contenuFormate = str_replace('[SLaaa]', '<br />', $contenuTrunc);


            $description = $contenuFormate;
        } else {
            $description = html_entity_decode($data_article[$i]['CONTENT']);
        }

        //Si les associations concordent

        if($data_article[$i]['ASSOCIATION_ID'] == $_SESSION['ASSOCIATION_ID'])
        {
            //Si l'article n'est pas validé

            if($data_article[$i]['STATUS'] == 0)
            {
                echo "<div id='article" . $data_article[$i]['ID']
                    . "' class='lienarticle '"

                    .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                    .      "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
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
                . $description
                . "</p>";
            echo "</div>";

                echo "</div>";


                echo "<input class='butt_valid' var='".$data_article[$i]['ID']."' type='submit' value='Validation'>";
                echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";


            }

            //Si l'article a déjà été validé

        else if($data_article[$i]['STATUS'] == 1)
        {
            echo "<div id='article" . $data_article[$i]['ID']
                . "' class='lienarticle"
                .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                .       "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
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
                . $description
                . "</p>";
            echo "</div>";

            echo "</div>";

            echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

        }
        }

    }
    ?>

</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>
<script type="text/javascript" src="Js/jqueryValidationArticle.js"></script>


<?php }


/*
    //VALIDATOR//
else if ( (isset($_SESSION)) && ($_SESSION['ROLE'] == 'VALIDATOR') )
{
global $data_article;
global $connec;


// AFFICHAGE

$state = $connec->prepare(
    "SELECT P.*, P.PTYPE, U.NAME, U.ASSOCIATION_ID, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
     FROM POST P, USER U
     WHERE P.WRITER_ID = U.ID AND (P.STATUS=0 OR P.STATUS=1) AND P.PTYPE='ARTICLE'
     ORDER BY ID DESC"
);
$state->execute();
$data_article = $state->fetchAll(PDO::FETCH_ASSOC); //Récupération des articles


?>

<div class="container-fluid pvarticle">
    <h1>Liste des articles</h1>
    <?php
    for($i = 0 ; $i < count($data_article) ; ++$i)
    {

        if(strlen($data_article[$i]['CONTENT']) > 250) {
            $contenuDecode = html_entity_decode($data_article[$i]['CONTENT']);

            $contenuDecode = str_replace('<br />', '[SLaaa]', $contenuDecode);
            $contenuDecode = str_replace('</p>', '[SLaaa]', $contenuDecode);
            $contenuTrunc = substr(strip_tags($contenuDecode), 0, 250);
            $contenuFormate = str_replace('[SLaaa]', '<br />', $contenuTrunc);


            $description = $contenuFormate;
        } else {
            $description = html_entity_decode($data_article[$i]['CONTENT']);
        }
        if($data_article[$i]['ASSOCIATION_ID'] == $_SESSION['ASSOCIATION_ID'])
        {
            if($data_article[$i]['STATUS'] == 0)
             {
            echo "<div id='article" . $data_article[$i]['ID']
                . "' class='lienarticle'"
                .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                .       "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
            echo "<div id='imgplace'> ";

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
                . $description
                . "</p>";
            echo "</div>";

                 echo "</div>";

                 echo "<input class='butt_valid' var='".$data_article[$i]['ID']."' type='submit' value='Validation'>";
                 echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

             }
        else if($data_article[$i]['STATUS'] == 1)
              {
            echo "<div id='article" . $data_article[$i]['ID']
                . "' class='lienarticle'"
                .      " data-theme='" . $data_article[$i]['THEME_ID'] . "'"
                .       "data-valid='"  . $data_article[$i]['STATUS']  . "'>";
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
                . $description
                . "</p>";
            echo "</div>";
                  echo "</div>";

          echo "</div>";

            echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

        }
        }

    }
    ?>

</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>
<script type="text/javascript" src="Js/jqueryValidationArticle.js"></script>


<?php }
*/