<?php 
	
	include 'DBase.php';

	$id = null;
	if ( !empty($_POST)) {
		$name = $_POST['NAME'];
                $surname = $_POST['SURNAME'];
		$email = $_POST['MAIL'];
		$cp = $_POST['CP'];
                $profession = $_POST['PROFESSION'];
		$valid = true;
		
		
		// update data
		
			$pdo = DBase::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE user  set NAME = :name, SURNAME = :surname,CP = :cp, MAIL = :mail, PROFESSION = :profession WHERE ID = :user_id";
			$q = $pdo->prepare($sql);
                        $q->bindParam(":name", $name, PDO::PARAM_STR);
                        $q->bindParam(":surname", $surname, PDO::PARAM_STR);
                        $q->bindParam(":cp", $cp, PDO::PARAM_INT);
                        $q->bindParam(":mail", $email, PDO::PARAM_STR);
                        $q->bindParam(":profession", $profession, PDO::PARAM_STR);
                        $q->bindParam(":user_id", $id, PDO::PARAM_INT);
			$q->execute();
			DBase::disconnect();
			header("Location: .index.php?EX=manageMembers");
		}
	