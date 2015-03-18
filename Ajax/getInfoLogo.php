<?php
	require_once('../Model/MGetLogo.mod.php');
	require_once('../Model/MDBase.mod.php');
	$getLogo = new MGetLogo();

	$result = $getLogo->getInfoLogo(htmlspecialchars($_POST['idAsso']));
	
	echo json_encode($result);
?>