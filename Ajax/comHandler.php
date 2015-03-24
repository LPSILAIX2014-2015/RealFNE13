<?php
	require_once('../Model/MDBase.mod.php');
	require_once('../Model/MCommentaire.mod.php');
    session_start();

	$mcom = new MCommentaire();
	switch($_POST['role'])
	{
		case 'getCommentaire' :
			$result = $mcom->getCommentairePost($_POST['idPost']);
			$jsonarray = array("com" => $result, "session" => $_SESSION);
			echo json_encode($jsonarray);
			break;
		case 'addCommentaire' :
			$result = $mcom->addCommentairePost($_POST['idPost'], $_POST['content']);
			$jsonarray = array("isInsert" => $result);
			echo json_encode($jsonarray);
			break;
		case 'deleteCommentaire' :
			$result = $mcom->deleteCommentaire($_POST['idcom']);
			$jsonarray = array("deleted" => $result);
			echo json_encode($jsonarray);
			break;
		case 'updateCommentaire' :
			$result = $mcom->updateCommentaire($_POST['idcom'], $_POST['content']);
			$jsonarray = array("updated" => $result);
			echo json_encode($jsonarray);
			break;
	}
	

?>