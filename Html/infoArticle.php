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
<br/>
<div>
	<?php



	?>
	<form method="post" action="index.php?EX=submitCommentary">
	    <textarea id="textareaId" cols="58" rows="8"></textarea>
        <input type="submit" class="btn btn-success" value="Ajouter un commentaire"/>
    </form>
</div>