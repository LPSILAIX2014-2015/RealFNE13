<?php

	$pdo = new MDBase();
	if ( !empty($_POST)) {
        $user= new MUser($_SESSION['ID_USER']);
        $assoc= $user->getAssociation();
<<<<<<< HEAD
				if(isset($_POST['ASSOCIATION']))
					$assoc= $_POST['ASSOCIATION'];
=======
        echo $assoc;
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
        $error = null;
		$name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $email = $_POST['MAIL'];
        $data = $pdo->getUserByEmail($email);
<<<<<<< HEAD
				$role= 'MEMBRE';
				if(isset($_POST['ROLE']))
					$role= $_POST['ROLE'];
=======
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
        // insert data
        var_dump($data);
		if (count($data) == 0) {

<<<<<<< HEAD
			$sql = "INSERT INTO USER (NAME,SURNAME,MAIL,ASSOCIATION_ID,ROLE) values(?, ?, ?, ?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $surname, $email,$assoc,$role));
=======
			$sql = "INSERT INTO USER (NAME,SURNAME,MAIL,ASSOCIATION_ID,ROLE) values(?, ?, ?, ?,'MEMBRE')";
			$q = $pdo->prepare($sql);
			$q->execute(array($name, $surname, $email,$assoc));
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b

                $headers = "From: webmaster@domain.com \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html\r\n";
                $message = 'http://dev.laplateformeFNE13.fr/index.php?EX=updateMail&email='.$email;
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
