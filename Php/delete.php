<?php 
	require './DBase.php';
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = DBase::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
		$sql = "DELETE FROM user  WHERE ID = :id";
=======
		$sql = "DELETE FROM user  WHERE ID = ?";
>>>>>>> d82f2561348851b611a6513fe7ccb2e59c626a02
		$q = $pdo->prepare($sql);
                $q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		DBase::disconnect();
		header("Location: ../index.php?EX=manageMembers");
		
	} 
?>