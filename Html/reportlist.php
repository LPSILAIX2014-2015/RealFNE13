<?php
// Variables, accès base & données nécessaires
$db = new DBase();
$statement = $db->query("SELECT * FROM REPORT");
$allReports = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($_SESSION["ROLE"] == "SADMIN") {
?>
<! -- Zone des filtres pour l'affichage des rapports. Par défaut : Tout -->
<div class="report_filters">
    <form id="form_radio" class="well well-sm text-center">
        <fieldset><legend>Filtrer les rapports</legend>
            <label for="p_filter">Profils</label><input id="p_filter" name="radioreport" type="radio" value="PROFIL"/>
            <label for="a_filter">Article</label><input id="a_filter" name="radioreport" type="radio" value="ARTICLE"/>
            <label for="m_filter">Message</label><input id="m_filter" name="radioreport" type="radio" value="MESSAGE"/>
            <br/>
            <label for="t_filter">Tout</label><input checked id="t_filter" name="radioreport" type="radio" value="ALL"/>
        </fieldset>
    </form>
</div>
<! -- Zone d'affichage (dynamique) des rapports -->
<h1>Liste des rapports</h1>
<div class="result_reports well well-lg">
    <table>
        <?php
        foreach ($allReports as $tuple) {
            echo "<div class=\"ALL ".$tuple['TYPE']."\">" . $tuple['ID'] . " - " . $tuple['RDATE'] . " - " . $tuple['CONTENT'] . "</div>";
            // Exemple : <div class="ALL MESSAGE">133 - 21/12/2014 - Huguette2 a contacté Francis1</div>
        }
        ?>
    </table>
</div>
<! -- JavaScript pour le changement d'affichage en fonction des filtres -->
<script type="text/javascript">
    // Se déclenche lorsque le filtre est changé
    $('#form_radio input[type=radio]').change(function() {
        vall = $(this).val();	// Récupération de la variable du filtre
        $(".ALL").hide();		// On cache tous les rapports
        $("."+vall).show(250);	// On affiche en fondu les rapports concernés par le filtre
    })
</script>
<?php } else {} ?>

<! -- JavaScript pour le changement d'affichage en fonction des filtres -->
<script type="text/javascript">
    // Se déclenche lorsque le filtre est changé
    $('#form_radio input[type=radio]').change(function() {
        vall = $(this).val();	// Récupération de la variable du filtre
        $(".ALL").hide();		// On cache tous les rapports
        $("."+vall).show(250);	// On affiche en fondu les rapports concernés par le filtre
    })
</script>