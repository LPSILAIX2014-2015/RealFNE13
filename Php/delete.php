<?php
	require_once('../Model/MDBase.mod.php');
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		
		// delete data
        $pdo = new MDBase();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM Message  WHERE SENDER_ID = ? OR RECEIVER_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id, $id));
		$sql = "DELETE FROM user  WHERE ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
        header("Location: ../index.php?EX=manageMembers");
	} 
?>