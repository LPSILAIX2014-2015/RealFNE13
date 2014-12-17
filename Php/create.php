<?php 
	
	require './DBase.php';
        $pdo = DBase::connect();
	if ( !empty($_POST)) {
                $error = null;
		$name = $_POST['NAME'];
                $surname = $_POST['SURNAME'];
                $email = $_POST['MAIL'];
		$cp = $_POST['CP'];
               $data = DBase::getUserByEmail($email);
                // insert data
                $assoc_id = 1;
                $theme_id = 1;
                $theme_interest_id = 1;
                if ($data == false) {
			
			$sql = "INSERT INTO user (NAME,SURNAME,CP,MAIL,ASSOCIATION_ID, THEME_ID, THEME_INTEREST_ID) values(:name, :surname, :cp, :mail, :association_id, :theme_id, :theme_interest_id)";
			$q = $pdo->prepare($sql);
                        $q->bindParam(":name", $name, PDO::PARAM_STR);
                        $q->bindParam(":surname", $surname, PDO::PARAM_STR);
                        $q->bindParam(":cp", $cp, PDO::PARAM_INT);
                        $q->bindParam(":mail", $email, PDO::PARAM_STR);
                        $q->bindParam(":association_id", $assoc_id, PDO::PARAM_INT);
                        $q->bindParam(":theme_id", $theme_id, PDO::PARAM_INT);
                        $q->bindParam(":theme_interest_id", $theme_interest_id, PDO::PARAM_INT);
			$q->execute();
			DBase::disconnect();
                        $headers = "From: webmaster@domain.com \r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html\r\n";
                
                $message = $_SERVER['REQUEST_URI'].'/../Html/update-mail.php?email='.$email;
                $subject = 'compléter votre profil';
                 mail ($mail,$subject,$message,$headers);
		
			header("Location: ../Html/datatable.php");
		}else {
                    
                    header("Location: ../Html/create.php?error=true");
                }
	}
?>
