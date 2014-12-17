<?php 
	require './DBase.php';
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = DBase::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM user  WHERE ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		DBase::disconnect();
		header("Location: ../index.php?EX=manageMembers");
		
	} 
?>