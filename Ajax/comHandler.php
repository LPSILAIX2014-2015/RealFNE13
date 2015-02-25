<?php
	require_once('../Model/MDBase.mod.php');
	require_once('../Model/MCommentaire.mod.php');

	$mcom = new MCommentaire();
	$result = $mcom->getCommentairePost($_POST['idPost']);
	$jsonarray = array("com" => $result);
	echo json_encode($jsonarray);

?>