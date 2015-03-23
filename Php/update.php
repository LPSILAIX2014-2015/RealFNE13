<?php
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	if ( !empty($_POST)) {
        $name = $_POST['NAME'];
        $surname = $_POST['SURNAME'];
        $theme = $_POST['THEME_ID'];
        $theme2 = $_POST['THEME_INTEREST_ID'];
        $themedetails = $_POST['THEME_DETAILS'];
        $cp = $_POST['CP'];
        $profession = $_POST['PROFESSION'];
        $profession2 = $_POST['PROFESSION2'];
        $presentation = $_POST['PRESENTATION'];
        $content_dir = '../Photos/'; // dossier où sera déplacé le fichier
        $tmp_file = $_FILES['sel_img']['tmp_name'];
        $name_file = $_FILES['sel_img']['name'];
        move_uploaded_file($tmp_file, $content_dir . $name_file);
        $photo_dir = $content_dir . $name_file;
        $valid = true;

        // update data
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE USER  set NAME = ?, SURNAME = ?, CP = ?, PROFESSION =?, PROFESSION2 = ?, THEME_ID = ?, THEME_INTEREST_ID = ?, THEME_DETAILS = ?, PRESENTATION = ?, PHOTOPATH = ? WHERE ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $surname, $cp, $profession, $profession2, $theme, $theme2, $themedetails, $presentation, $photo_dir, $id));
				$mNotification = new MNotification();

				// $receiver_id ==> id de l'User
				// $content ==> contenu de la notification
				$content= 'Vos informations ont été modifiées par votre administrateur. En cas de problème, veuillez le contacter';
				$mNotification->sendNotificationToUser($id, $content);

        header("Location: ./index.php?EX=manageMembers");
    }
