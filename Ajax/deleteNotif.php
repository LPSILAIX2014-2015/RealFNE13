<?php
	require_once('../Model/MDBase.mod.php');
	$database = new MDBase();

	$state = $database->prepare("DELETE FROM NOTIFICATION WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['ID']), PDO::PARAM_INT);
    $state->execute();

	echo json_encode(true);
?>