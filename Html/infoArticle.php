<?php
	global $article;

 	echo '<h1>' . $article[0]['TITLE'] . '</h1>';
 	echo '<em>' . $article[0]['AUTHOR_NAME'] . ' ' . $article[0]['AUTHOR_SURNAME'] . ', le ' . $article[0]['PDATE']. '</em>';

 	if($article[0]['IMAGEPATH'] != 'NULL') {
 		echo '<div id="imgArticle">'
 		  .    '<img src="' . $article[0]['IMAGEPATH'] . '" class="img-responsive" />'
 		  .  '</div>';
 	}

 	echo '<p>' . $article[0]['CONTENT'] . '</p>';

?>