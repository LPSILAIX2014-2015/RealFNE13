<?php
        $pdo = new MDBase();
		$to = $_POST['emailto'];
                $id = 1;
                if(isset($_POST['id'])) {
                    $id = $_POST['id'];
                }
                $message = $_POST['content'];
                $subject = $_POST['title'];
                
                $sql = 'SELECT * FROM user WHERE USER_ID = '. $id;
                foreach ($pdo->query($sql) as $row) {
                    $email = $row['MAIL'];
                    $header = "From: ". $email ." \r\n";
                
                }
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                if(!empty($to)){
                    $emails = explode(",", $to);
                }else {
                    $emails = array();
                    $emails[] = $email;
                }
                
                foreach ($emails as $mail) {
                    $sql1 = "SELECT * FROM user WHERE MAIL LIKE '". $mail . "'";
                    foreach ($pdo->query($sql1) as $row1) {
                        $sender = DBase::getUserByEmail($_POST['sender']);
                        $sender_id = 1;
                        if(!empty($sender)) {
                            $sender_id = $sender['USER_ID'];
                        }
                        $query = "INSERT INTO messages (SENDER,RECEIVER,TITLE,CONTENT) values(?, ?, ?, ?)";
                        $q = $pdo->prepare($query);
                        $q->execute(array($sender_id, $row1['USER_ID'], $subject, $message));
                    }
                    mail ($mail,$subject,$message,$header);
                }
?>
