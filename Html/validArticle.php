<?php

$db=new MDBase();

//Préparation des requêtes SQL
$fil = 0;
if (( (isset($_SESSION)) && ($_SESSION['ROLE'] == 'SADMIN')) )
{
        if (isset($_GET["FILTER"]) && $_GET["FILTER"] == '1') { $fil = 1; }

        $str = "SELECT  COUNT(*) TOT FROM POST WHERE STATUS =".$fil;

        $str1= "SELECT P.*, P.PTYPE, U.NAME, U.ASSOCIATION_ID, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
                FROM POST P, USER U
                WHERE P.STATUS=".$fil."
                AND P.PTYPE='ARTICLE' ";



}

else if ( (isset($_SESSION)) && ( ($_SESSION['ROLE'] == 'ADMIN') || ($_SESSION['ROLE'] == 'VALIDATOR')) ) {

    if (isset($_GET["FILTER"]) && $_GET["FILTER"] == '1') { $fil = 1; }

    $str = "SELECT COUNT(*) TOT
            FROM POST P, USER U, USER W
            WHERE P.STATUS=".$fil ." AND P.PTYPE='ARTICLE'
            AND U.ASSOCIATION_ID =".$_SESSION["ASSOCIATION_ID"]."
            AND U.ASSOCIATION_ID = W.ASSOCIATION_ID
            AND W.ID = WRITER_ID
            ORDER BY ID DESC";

    $str1= "SELECT P.*, P.PTYPE, U.NAME, U.ASSOCIATION_ID, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE
            FROM POST P, USER U, USER W
            WHERE P.STATUS=".$fil." AND P.PTYPE='ARTICLE'
            AND U.ASSOCIATION_ID =".$_SESSION["ASSOCIATION_ID"]."
            AND U.ASSOCIATION_ID = W.ASSOCIATION_ID
            AND W.ID = WRITER_ID ";

}
else {
    require_once('../index.php?EX=error');
}

$ret_stat = $db->prepare($str);
$ret_stat->execute();
$rez = $ret_stat->fetch(PDO::FETCH_ASSOC);

$nombreDePages=ceil($rez["TOT"]/10);

if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
    $pageActuelle=intval($_GET['page']);

    if($pageActuelle > $nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
    {
        $pageActuelle = $nombreDePages;
    }
}

else
{
    $pageActuelle=1; // La page actuelle est la n°1
}

$premiereEntree=($pageActuelle-1)*10; // On calcul la première entrée à lire

// La requête sql pour récupérer les messages de la page actuelle.

$sql = $str1 ."ORDER BY P.ID LIMIT ".$premiereEntree.", ".'10';

$sttt = $db->prepare($sql);
$sttt->execute();

//SUPER-ADMIN//
if ((isset($_SESSION)) && ($_SESSION['ROLE'] == 'SADMIN'))
{
    global $data_article;
    global $data_assoc;

    // La requête sql pour récupérer les messages de la page actuelle.
    $sttt = $db->prepare($str1);
    $sttt->execute();
    $data_article = $sttt->fetchAll(PDO::FETCH_ASSOC); //Récupération des articles
?>

    <!-- INSTALLATION DE LA MISE EN PAGE -->

    <div class="container-fluid pvarticle">
        <div class="filter">

            <select id="filterVALID">
                <?php if ($_GET["FILTER"] == 1) { ?>
                    <option value="1">- Validé</option>
                    <option value="0">- En attente de validation -</option>
                <?php } else { ?>

                    <option value="0">- En attente de validation -</option>
                    <option value="1">- Validé</option>
                <?php } ?>
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

            echo "<div id='article" . $data_article[$i]['ID']
                    . "' class='lienarticle validart '"

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
if($fil==0){
                echo "<input class='butt_valid' var='".$data_article[$i]['ID']."' type='submit' value='Validation'>";
                echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";
}

else{
    echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";
}


            //Artcile validé

       /* else if($data_article[$i]['STATUS'] == 1)
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

*/
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

// récupération des message de la page actuelle

    $stt = $db->prepare($str1);
    $stt->execute();
    $data_article = $stt->fetchAll(PDO::FETCH_ASSOC);

?>
    <!-- Préparation de l'affichage -->

<div class="container-fluid pvarticle">

    <div class="filter">

    <select id="filterVALID">
        <?php if($GET["FILTER"] == 1) {?>

        <option value="1">- Validé</option>
        <option value="0">- En attente de validation -</option>

        <?php } else { ?>
        <option value="0">- En attente de validation -</option>
        <option value="1">- Validé</option>

        <?php } ?>

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


            //Si l'article n'est pas validé


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

if($fil==0) {
    echo "<input class='butt_valid' var='".$data_article[$i]['ID']."' type='submit' value='Validation'>";
 echo "BLABLABLA";
    echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";

}
else{
    echo "<input class='butt_suppr' var='".$data_article[$i]['ID']."' type='submit' value='Suppression'>";
    echo "BLIBLIBLI";
}

            }




    }
    ?>

</div>
<div id='pagination' class='compact-theme simple-pagination'></div>

<script type="text/javascript" src="Js/showInfoArticle.js"></script>
<script type="text/javascript" src="Js/jqueryValidationArticle.js"></script>


<?php


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