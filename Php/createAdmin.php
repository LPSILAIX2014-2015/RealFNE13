<?php 

	$pdo = new MDBase();
	if ( !empty($_POST)) {
        $id=$_POST['ID'];
		$name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
		$cp = $_POST['CP'];

        $profession = $_POST['PROFESSION'];
        echo $id." ".$name." ".$surname." ".$email." ".$cp." ".$profession." ";
		$sql = "INSERT INTO user (NAME,SURNAME,CP,MAIL,ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID, ROLE,PROFESSION) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name, $surname, $cp, $email,$id, 1, 1,"ADMIN",$profession));

        $headers = "From: webmaster@domain.com \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html\r\n";
        
        $message = $_SERVER['REQUEST_URI'].'/../Html/update-mail.php?email='.$email;
        $subject = 'compléter votre profil';
        mail ($mail,$subject,$message,$headers);

        header("Location: ./index.php");

	}
?>
