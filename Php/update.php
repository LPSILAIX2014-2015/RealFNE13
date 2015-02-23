<?php
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( !empty($_POST)) {
        $name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
        $cp = $_POST['CP'];
        $profession = $_POST['PROFESSION'];
        $valid = true;

        // update data
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE USER  set NAME = ?, SURNAME = ?,CP = ?, MAIL = ?, PROFESSION =? WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $surname, $cp, $email, $profession, $id));
        header("Location: ./index.php?EX=manageMembers");
    }
