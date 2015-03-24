<?php
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( !empty($_POST)) {
		$user= new MUser($_SESSION['ID_USER']);
        $name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $theme = $_POST['THEME'];
        $theme2 = $_POST['THEME2'];
        $themedetails = $_POST['DETAILS'];
        $cp = $_POST['CP'];
        $profession = $_POST['PROFESSION'];
        $profession2 = $_POST['PROFESSION2'];
        $presentation = $_POST['PRESENTATION'];
        $valid = true;

        // update data
        $pdo = new MDBase();
				$msg = $user->getName().' '.$user->getSurname().' a modifié l\'utilisateur: '.$name.' '.$surname.'.';
				$query = 'INSERT INTO REPORT VALUES (NULL, CURDATE(), "PROFIL", "'.$msg.'");';
				$state = $pdo->prepare($query);
				$state->execute();

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE USER  set NAME = ?, SURNAME = ?, CP = ?, PROFESSION =?, PROFESSION2 = ?, THEME_ID = ?, THEME_INTEREST_ID = ?, THEME_DETAILS = ?, PRESENTATION = ? WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $surname, $cp, $profession, $profession2, $theme, $theme2, $themedetails, $presentation, $id));
				$mNotification = new MNotification();

				// $receiver_id ==> id de l'User
				// $content ==> contenu de la notification
				$content= 'Vos informations ont été modifiées par votre administrateur. En cas de problème, veuillez le contacter';
				$mNotification->sendNotificationToUser($id, $content);

        header("Location: ./index.php?EX=manageMembers");
    }
