<?php
<<<<<<< HEAD
=======
	session_start();
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
	require_once('../Model/MDBase.mod.php');
	require_once('../Model/MCommentaire.mod.php');

	$mcom = new MCommentaire();
	switch($_POST['role'])
	{
		case 'getCommentaire' :
			$result = $mcom->getCommentairePost($_POST['idPost']);
			$jsonarray = array("com" => $result);
			echo json_encode($jsonarray);
			break;
		case 'addCommentaire' :
			$result = $mcom->addCommentairePost($_POST['idPost'], $_POST['content']);
			$jsonarray = array("isInsert" => $result);
			echo json_encode($jsonarray);
			break;
	}
	

?>