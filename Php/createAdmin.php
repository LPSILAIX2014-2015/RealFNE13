<?php

	$pdo = new MDBase();
	if ( !empty($_POST)) {
        $id=$_POST['ID'];
	$name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
		$sql = "INSERT INTO USER (NAME,SURNAME,MAIL,ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, ROLE) values(?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name, $surname, $email,$id, 1, 1,"ADMIN"));

        $headers = "From: webmaster@domain.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html\r\n";

				$message = $_SERVER['REQUEST_URI'].'http://laplateformeFNE13.fr/index.php?EX=updateMail.php?email='.$email;
        $subject = 'compléter votre profil';
        mail ($mail,$subject,$message,$headers);

        header("Location: ./index.php?EX=manageAsso");

	}
?>
