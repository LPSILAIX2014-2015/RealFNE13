<p>
Souhaitez-vous envoyer ce message à un autre destinataire ?<br><br>
<?php 
echo '<a href="'.'./index.php?EX=writeMessages&sujet'.'='.'\''.$_SESSION["title"].'\''.'&contenu'.'='.$_SESSION["content"].'&categorie='.$_SESSION["category"].'"><input type=button value="Oui" /></a> '; ?>
<a href="./index.php?EX=endMessages"><input type="button" value="Non" /></a><br><br>
<br><br>
</p>