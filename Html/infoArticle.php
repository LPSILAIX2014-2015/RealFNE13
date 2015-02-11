<?php
	global $article;
	$index = intval($_GET["id"])-1;

 	echo '<h1>' . $article[$index]['TITLE'] . '</h1>';
 	echo '<em>' . $article[$index]['AUTHOR_NAME'] . ' ' . $article[$index]['AUTHOR_SURNAME'] . ', le ' . $article[$index]['PDATE']. '</em>';

 	if($article[$index]['IMAGEPATH'] != 'NULL') {
 		echo '<img src="' . $article[$index]['IMAGEPATH'] . '" class="img-responsive" />';
 	}

 	echo '<p>' . $article[$index]['CONTENT'] . '</p>';
?>