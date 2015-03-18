<?php
/**
 * @author <Julien Bénard
 * affichage des derniers articles en colonne de gauche
 */

$sql = new MDBase();
$query = $sql->prepare("select POST.ID, TITLE, NAME, THEME.IMAGEPATH AS IMG
from POST, THEME
where PTYPE='ARTICLE' AND STATUS > 0
AND THEME_ID = THEME.ID
order by PDATE desc limit 0,5;") ;
$query->execute();
?>
<div class="recentarticles">
    <h5 class="titrecol">Derniers articles</h5>
    <ul>
        <?php

        while ($row = $query->fetch()) {
            if ($row['IMG'] != NULL) { $icone = 'Img/iconesthemes/'.$row['IMG']; }
            else { $icone = 'Img/pastille.png'; }
            echo '<li><a href="index.php?EX=showInfoArticle&id='.$row['ID'].'">'
               .   '<span class="iconesarticle"><img src="'.$icone.'"></span>'
               .   '<span class="titrearticle">'.$row['TITLE'].'</span>'
               . '</a></li>' ;
        }
        ?>
    </ul>
</div>