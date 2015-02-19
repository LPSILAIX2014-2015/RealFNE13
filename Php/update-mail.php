<?php
    include("../Model/MDBase.mod.php");
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

    if ( !empty($_POST))
    {
        $user_mail = $_GET['email'];
        $login = $_POST['LOGIN'];
        $mdp = $_POST['MOTDEPASSE'];
        if($mdp != $_POST['CONFIRMMOTDEPASSE']){
            header("Location: ../index.php?EX=updateMail&email=".$user_mail);
        }
        $mdp= md5($mdp);
        $address = $_POST['ADRESSE'];
        $cp = $_POST['CP'];
        $theme = $_POST['THEME'];
        $theme_interest = $_POST['THEME2'];
        $presentation = $_POST['PRESENTATION'];
        $details = $_POST['DETAILS'];
        $profession = $_POST['PROFESSION'];
        $profession2 = $_POST['PROFESSION2'];
        $content_dir = '../Photos/'; // dossier où sera déplacé le fichier
        $tmp_file = $_FILES['photo']['tmp_name'];
        $name_file = $_FILES['photo']['name'];
        move_uploaded_file($tmp_file, $content_dir . $name_file);
        $photo_dir = $content_dir . $name_file;
        $pdo = new MDBase();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE USER SET LOGIN = ?, PASSWORD = ?, ADRESS = ?, CP = ?, THEME_ID = ?, THEME_INTEREST_ID= ?, PROFESSION = ?, PRESENTATION = ?, PROFESSION2 = ?, THEME_DETAILS = ?, PHOTOPATH = ? WHERE MAIL = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($login, $mdp, $address, $cp, $theme, $theme_interest, $profession, $presentation, $profession2, $details, $photo_dir, $user_mail));
        header("Location: ../index.php");
        echo md5($mdp);
    }
