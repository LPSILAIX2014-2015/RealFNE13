<?php
	$id = 0;
	if ( !empty($_POST)) {
		// keep track post values
		$id = $_POST['id'];
		$user= new MUser($_SESSION['ID_USER']);
		$deleted= new MUser($id);
		// delete data
        $pdo = new MDBase();
				$msg = $user->getName().' '.$user->getSurname().' a supprimé l\'utilisateur: '.$deleted->getName().' '.$deleted->getSurname().'.';
				$query = 'INSERT INTO REPORT VALUES (NULL, CURDATE(), "PROFIL", "'.$msg.'");';
				$state = $pdo->prepare($query);
				$state->execute();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM MESSAGE  WHERE SENDER_ID = ? OR RECEIVER_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id, $id));
		$sql = "DELETE FROM USER  WHERE ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));

		header("Location: ./index.php?EX=manageMembers");
	}
?>
