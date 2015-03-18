<?php
	global $article;

 	echo '<h1>' . $article[0]['TITLE'] . '</h1>';
 	echo '<em>' . $article[0]['AUTHOR_NAME'] . ' ' . $article[0]['AUTHOR_SURNAME'] . ', le ' . $article[0]['PDATE']. '</em>';

 	if($article[0]['IMAGEPATH'] != NULL) {
 		echo '<div id="imgArticle">'
 		  .    '<img src="' . $article[0]['IMAGEPATH'] . '" class="img-responsive" />'
 		  .  '</div>';
 	}

 	echo '<p>' . html_entity_decode($article[0]['CONTENT']) . '</p>';

?>
<br/>
<hr>
<h3 id="titleCom">ESPACE COMMENTAIRE</h3>
<hr>
<br/>
<?php
	echo '<div id="divCom" idArticle="'.$article[0]['ID'].'"> </div>';
?>

<div id='pagination' class='compact-theme simple-pagination'></div>
<form id="newCom" method="post" action="">
    <textarea id="textareaId" cols="58" rows="8"></textarea>
    <input type="submit" id="clickNewCom" class="btn btn-success" value="Ajouter un commentaire"/>
</form>