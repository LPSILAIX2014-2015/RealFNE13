<?php 
	require '../Model/MDBase.mod.php';
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
		$pdo = new MDBase();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM USER  WHERE ASSOCIATION_ID = :id";

		$q = $pdo->prepare($sql);
                $q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();

		$sql = "DELETE FROM association  WHERE ID = :id";

		$q = $pdo->prepare($sql);
                $q->bindParam(":id", $id, PDO::PARAM_INT);
		$q->execute();
		header("Location: ../index.php?EX=manageAsso");
		
	} 
?>