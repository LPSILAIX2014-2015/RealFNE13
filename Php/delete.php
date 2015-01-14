<?php 
	require '../Model/DBase.mod.php';
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = DBase::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "DELETE FROM user  WHERE ID = :id";
		$q = $pdo->prepare($sql);
                $q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		DBase::disconnect();
		header("Location: ../index.php?EX=manageMembers");
		
	} 
?>