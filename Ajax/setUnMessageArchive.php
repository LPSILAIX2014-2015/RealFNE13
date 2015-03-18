<?php
	require_once('../Model/MDBase.mod.php');
	$database = new MDBase();

	$state = $database->prepare("UPDATE MESSAGE SET ISARCHIVE = :no WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
    $state->bindValue('no', 0, PDO::PARAM_INT);
    $state->execute();

	echo json_encode(true);
?>