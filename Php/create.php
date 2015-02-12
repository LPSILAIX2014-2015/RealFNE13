<?php
    
	$pdo = new MDBase();
	if ( !empty($_POST)) {
        $user= new MUser($_SESSION['ID_USER']);
        $assoc= $user->getAssociation();
        echo $assoc;
        $error = null;
		$name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
        $data = $pdo->getUserByEmail($email);
        // insert data
        var_dump($data);
		if (count($data) == 0) {
			
			$sql = "INSERT INTO USER (NAME,SURNAME,MAIL,ASSOCIATION_ID,ROLE) values(?, ?, ?, ?,'MEMBRE')";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $surname, $email,$assoc));

                $headers = "From: webmaster@domain.com \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html\r\n";
                $message = $_SERVER['REQUEST_URI'].'http://laplateformeFNE13/index.php?EX=updateMail.php?email='.$email;
                $subject = 'compléter votre profil';
                 mail ($email,$subject,$message,$headers);

            header("Location: ./index.php?EX=manageMembers");
        }

		else
		{
            header("Location: ./index.php?EX=createMember&error=true");
        }
	}
?>
