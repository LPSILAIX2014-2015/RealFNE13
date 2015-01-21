<?php 
/**
 * @author <Cesar Hernandez>
 */
class CRecMP{

private $conn;
private $mail;
	/**
	 * [__construct Instantiation de la variable $_mail]
	 * @param [String] $_mail [mail d'user]
	 */
	public function __construct($_mail=null){
		$this->conn = new MDBase();
		$this->mail=$_mail;
	}
	public function __destruct(){}
	/**
	 * [updateMotPasse Mise en jour de mt de passe]
	 * @param  [String] $_data [la nouveaux mot de passe]
	 * @return [type]        [resultat du mise à jour]
	 */
	public function updateMotPasse($_data){
		$encrypt = md5($_data['pass1']);
		$query = "UPDATE USER set password = '$encrypt' where MAIL = '$this->mail'";

		$result = $this->conn->prepare($query);

		return $result->execute();

 	} // updateMotPasse($_data)
 	/**
 	 * [updateReset creation du lien temporaire]
 	 * @param  [String] $strEnc [chaine aleatoire]
 	 * @return [type]        [resultat du mise à jour]
 	 */
 	public function updateReset($strEnc){

		$query = "UPDATE USER set RESET = '$strEnc' where MAIL = '$this->mail'";

		$result = $this->conn->prepare($query);

		return $result->execute();

 	} // updateReset($strEnc)

 	/**
 	 * [updateRSB uppression de données de l'attribut de la BD]
 	 * @return [type][resultat du mise à jour]
 	 */
	public function updateRSB(){

		$query = "UPDATE USER set RESET = '' where MAIL = '$this->mail'";

		$result = $this->conn->prepare($query);

		return $result->execute();

 	} // updateRSB
 	/**
 	 * [searchMail Recherche du mail dans la BD]
 	 * @param  [type] $val [chaine aleatoire de l'URL]
 	 * @return [type][resultat du mise à jour]
 	 */
 	public function searchMail($val){
 		$query = "SELECT MAIL from USER where RESET='$val'";

 		$result = $this->conn->prepare($query);

 		$result->execute();
 		return $result->fetchAll(PDO::FETCH_ASSOC);
  	} // Select()
  	/**
  	 * [selectMail Verification d'existence de l'email]
  	 * @return [type][resultat du recherche]
  	 */
 	public function selectMail(){
 		$query = "SELECT * from USER where MAIL='$this->mail'";

 		$result = $this->conn->prepare($query);

 		$result->execute();
 		return $result->fetchAll(PDO::FETCH_ASSOC);
  	} // Select()
/**
 * [sendMail Envoi du mail de changement demot passe ]
 * Rappelez que cette partie se changera pour le lien correcte '<a>...</a>'
 */
  	public function sendMail(){
  		$to = $this->mail;
  		$subject = "Changement de mot de passe";
  		$message="<!DOCTYPE html>
					<html lang='fr'>
					<head>
						<meta charset='UTF-8'>
						<title>Changement du mot de passe</title>
					</head>
					<body>
						<h1 style='color: blue;'>Felicitations vous avez changé votre mot de passe</h1>
						Pour acceder a votre compte faire click sur le suivant lien:
						<a href='http://pruebasxd.esy.es/RealFNE13-master/index.php?EX=login'>Acceder à mon compte</a>
						<p style='font-size: 10pt;'>Si vous n'avez pas solicité le changement s'il vous plaît parlez avec l'administrateur.</p>
					</body>
					</html>";
  		$headers="MIME-Version: 1.0"."\r\n";
  		$headers.="Content-type: text/html; charset=utf-8"."\r\n";
  		$headers.="To: $this->mail"."\r\n";
  		$headers.="From: mail@prueba.fr"."\r\n";
  		mail($to, $subject, $message, $headers);
  	}// sendMail()

  	/**
  	 * [sendMailConf Envoi du mail pour faire le cahngement de mot de passe]
  	 * Rappelez que cette partie se changera pour le lien correcte '<a>...</a>'
  	 */
  	public function sendMailConf(){
  		$ranStr = md5(substr( sha1( microtime() ),0,6));

  		$to = $this->mail;
  		$subject = "Changement de mot de passe";
  		$message="<!DOCTYPE html>
					<html lang='fr'>
					<head>
						<meta charset='UTF-8'>
						<title>Changement de mot de passe</title>
					</head>
					<body>
						<h5>".date('l jS \of F Y')."</h5>
						<h1 style='color: blue;'>Vous avez reçu cet email pour commencer le  changement de votre mot de passe</h1>
						Pour faire le changement faire click sur le suivant lien:
						<a href='http://pruebasxd.esy.es/RealFNE13-master/index.php?EX=$ranStr' style='text-decoration: none;'>Changer mon mot de passe</a>
						<p style='font-size: 10pt;'>Si vous n'avez pas solicité le changement s'il vous plaît parlez avec l'administrateur.</p>
					</body>
					</html>";
  		$headers="MIME-Version: 1.0"."\r\n";
  		$headers.="Content-type: text/html; charset=utf-8"."\r\n";
  		$headers.="To: $this->mail"."\r\n";
  		$headers.="From: mail@prueba.fr"."\r\n";
  		mail($to, $subject, $message, $headers);
  		
  		return $this->updateReset($ranStr);
  	}// sendMailConf()

  	/**
  	 * [selectMD5 Verification de la chaine de l'URL]
  	 * @param  [type] $val [variable de l'URL]
  	 * @return [type]      [Resultat de la recherche]
  	 */
  	public function selectMD5($val){
		$query = "SELECT * FROM USER where RESET='$val'";

		$result = $this->conn->prepare($query);

 		$result->execute();
 		return $result->fetchAll(PDO::FETCH_ASSOC);

 	} // selectMD5($val)
}
?>
