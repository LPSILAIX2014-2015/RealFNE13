<?php
    $user= $GLOBALS['user'];
    if ((isset($user)) && ($user->getRole() == "SADMIN")) {
    echo $user->getRole();
    $db = new MDBase();
    $stat = new PDOStatement();
    $stat = $db->prepare("SELECT * FROM REPORT");
    $stat->execute();

?>
<div class="report_filters">
    <form id="form_radio" class="well well-sm text-center">
        <fieldset><legend>Filtrer les rapports</legend>

        <input id="report_filter_profile" name="radioreport" type="radio" value="PROFIL"/>
        <label for="report_filter_profile">Profils</label>
            <input id="report_filter_article" name="radioreport" type="radio" value="ARTICLE"/>
        <label for="report_filter_article">Article</label>
            <input id="report_filter_message" name="radioreport" type="radio" value="MESSAGE"/>
        <label for="report_filter_message">Message</label>
            <input id="report_filter_alert" name="radioreport" type="radio" value="ALERTE"/>
        <label for="report_filter_alert">Sécurité</label>
            <input id="report_filter_all" name="radioreport" type="radio" value="ALL" checked="checked"/>
        <label for="report_filter_all">Tout</label>

        </fieldset>
    </form>
</div>
<h1>Liste des rapports</h1>
<div class="result_reports well well-lg">
    <table>
        <?php
            while ($res = $stat->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="ALL '.$res['TYPE'].'">
                <span class="reportid">' . $res['ID'] . '</span>
                <span class="reportdate">' . $res['RDATE'] . '</span>
                <span class="reportcontent">' . $res['CONTENT'] . '</span>
                </div>';
            }
        ?>
    </table>
</div>
<script type="text/javascript" src="Js/reportList.js"></script>
<?php } else {  ?>
<div>Vous n'avez pas les droits nécesaires pour accéder à cette page !</div>
<?php }?>