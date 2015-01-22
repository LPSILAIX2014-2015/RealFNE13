<?php 
    
	$pdo = new MDBase();
	if ( !empty($_POST)) {
        $user= new Muser($_SESSION['ID_USER']);
        $assoc= $user->getAssociationID();
        echo $assoc;
        $error = null;
		$name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
		$cp = $_POST['CP'];

        $profession = $_POST['PROFESSION'];
        $data = $pdo->getUserByEmail($email);
        // insert data
        var_dump($data);
		if (count($data) == 0) {
			
			$sql = "INSERT INTO user (NAME,SURNAME,CP,MAIL,ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID) values(?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $surname, $cp, $email,$assoc, 1, 1));

                        $headers = "From: webmaster@domain.com \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html\r\n";
                
                $message = $_SERVER['REQUEST_URI'].'/../Html/update-mail.php?email='.$email;
                $subject = 'compléter votre profil';
                 mail ($mail,$subject,$message,$headers);

            header("Location: ./index.php?EX=manageMembers");
        }

		else
		{
             header("Location: ./index.php?EX=createMember&error=true");
        }
	}
?>
