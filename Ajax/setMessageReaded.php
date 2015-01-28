<?php
	$database = new MDBase();

	$state = $database->prepare("UPDATE MESSAGES SET ISREADED = 1 WHERE ID = :id");
    $state->bindValue('id', htmlspecialchars($_GET['id']), PDO::PARAM_INT);
    $state->execute();

	echo json_encode(true);
?>