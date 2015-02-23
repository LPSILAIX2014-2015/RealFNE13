<?php
	require_once('../Model/MDBase.mod.php');
	$database = new MDBase();

	$state = $database->prepare("SELECT PATH_FILE FROM CLOUD WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
    $filename = $result['PATH_FILE'];

	$state = $database->prepare("DELETE FROM CLOUD WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
    $state->execute();

	unlink('../Cloud/'.$filename);

	echo json_encode(true);
?>