<?php
	session_start();
	$ranStr = substr( sha1( microtime() ),0,6); // creation d'une chaine aleatoire

	//Enregistre le valeur de la chaine aleatoire dans une variable de session
	$_SESSION['captcha'] = $ranStr; 

	// creation d'une image avec php...
	$newImage = imagecreatefromgif( "../Img/bgcaptcha.gif" ); 

<<<<<<< HEAD
	// la fonction imagecolorallocate ( $image , rouge , vert , bleu ) génère une couleur
=======
	// la fonction imagecolorallocate ( $imagen , rojo , verde , azul ) génère une couleur 
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
	$txtColor = imagecolorallocate($newImage, 0, 0, 200); 

	// bool imagestring ( resource $image , int $font , int $x , int $y , string $string , int $color )
	imagestring($newImage, 5, 30, 8, $ranStr, $txtColor); 

	// indique le type de conenu à afficher dnas ce cas image type GIF
	header( "Content-type: image/gif" );
	// creation de l'image
	imagegif($newImage);
?>