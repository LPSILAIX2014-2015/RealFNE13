<?php
	$id = null;
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
        $sql = "UPDATE user  set NAME = ?, SURNAME = ?,CP = ?, MAIL = ?, PROFESSION =? WHERE USER_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $surname, $cp, $email, $profession, $id));
        header("Location: index.php?EX=manageMembers");
    }
	