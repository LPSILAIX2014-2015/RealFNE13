<?php
	require_once('../Model/MDBase.mod.php');
	$database = new MDBase();

	$state = $database->prepare("UPDATE MESSAGE SET ISARCHIVE = :yes WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
    $state->bindValue('yes', 1, PDO::PARAM_INT);
    $state->execute();

	echo json_encode(true);
?>