<?php

    if ($_SESSION["ROLE"] == "SADMIN") {
    $db = new MDBase();
    $stat = new PDOStatement();
    $stat = $db->prepare("SELECT * FROM REPORT");
    $stat->execute();

?>
<div class="report_filters">
    <form id="form_radio" class="well well-sm text-center">
        <fieldset><legend>Filtrer les rapports</legend>
        <label for="report_filter_profile">Profils</label><input name="radioreport" type="radio" value="PROFIL"/>
        <label for="report_filter_article">Article</label><input name="radioreport" type="radio" value="ARTICLE"/>
        <label for="report_filter_message">Message</label><input name="radioreport" type="radio" value="MESSAGE"/>
        <br/><label for="report_filter_message">Tout</label><input name="radioreport" type="radio" value="ALL"/>
        </fieldset>
    </form>
</div>
<h1>Liste des rapports</h1>
<div class="result_reports well well-lg">
    <table>
        <?php
            while ($res = $stat->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class=\"ALL ".$res['TYPE']."\">" . $res['ID'] . " - " . $res['RDATE'] . " - " . $res['CONTENT'] . "</div>";
            }
        ?>
    </table>
</div>
<script type="text/javascript">
    $('#form_radio input[type=radio]').change(function(){
        vall = $(this).val();
        $(".ALL").hide();
        $("."+vall).show(250);
    })
</script>
<?php } else { echo var_dump($_SESSION); ?>
<div>Vous n'avez pas les droits nécesaires pour accéder à cette page !</div>
<?php }?>