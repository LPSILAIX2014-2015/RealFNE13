<?php
/**
 * @author <Julien Bénard
 * affichage des derniers articles en colonne de gauche
 */

$sql = new MDBase();
$query = 'select ID, TITLE, THEME_ID  from POST order by PDATE desc limit 0,5;' ;
$result = $sql->query($query);
if ($result->rowCount() > 0) {
    $tab_themes = array(1 => 'transport-mobilite-durable.png',
                        2 => 'mission-juridique.png',
                        3 => 'climat-air-energie.png',
                        4 => 'sante-et-environnement.png',
                        5 => 'amenagement-durable-urbanisme.png',
                        6 => 'industrie.png',
                        7 => 'eau-milieu-naturel.png',
                        8 => 'agriculture.png'
                        );
?>
<div class="recentarticles">
    <h5 class="titrecol">Derniers articles</h5>
    <ul>
        <?php
        while ($row = $result->fetch()) {
            if ($row['THEME_ID'] != 0) { $icone = 'Img/iconesthemes/'.$tab_themes[$row['THEME_ID']]; }
            else { $icone = 'Img/pastille.png'; }
            echo '<li><span class="iconesarticle"><img src="'.$icone.'"></span><span class="titrearticle">'.$row['TITLE'].'</span></li>' ;
        }
        ?>
    </ul>
</div>
<?php
}
?>