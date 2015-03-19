<?php
	require('../Inc/require.inc.php');
	$formCreateArticle = new MFormCreateArticle();
	$nextId = $formCreateArticle->insertDB($_POST);

	if($nextId == ''){
		$url = 'Location: ../index.php?EX=showInfoArticle&id=1';
	    header($url);
	}else{
	    $url = 'Location: ../index.php?EX=showInfoArticle&id='.$nextId;
	    header($url);
	}
?>