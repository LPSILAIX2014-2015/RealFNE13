<?php
class VShowArticle
{
<<<<<<< HEAD
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showArticle($_html)
  {

    $connec = new MDBase();
    global $data_article;
    global $data_assoc;
    global $data_theme;

  	// AFFICHAGE
  	$state = $connec->prepare(
  	  "SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
              U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
  	   FROM POST P, USER U
  	   WHERE P.WRITER_ID = U.ID
  	   ORDER BY id DESC"
  	);
  	$state->execute();
  	$data_article = $state->fetchAll(PDO::FETCH_ASSOC);

    $data_assoc = $connec->getAllAssocs();
    $data_theme = $connec->getAllThemes();


    $state = $connec->prepare(
      "SELECT P.*, U.NAME, U.SURNAME, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE 
       FROM POST P, USER U
       WHERE P.WRITER_ID = U.ID
       ORDER BY id DESC"
    );
    $state->execute();
    $data_article = $state->fetchAll(PDO::FETCH_ASSOC);


    // REMPLISSAGE DU CONTENU

    $vhtml = new VHtml();
    $vhtml->showHtml($_html);

  } // showShowArticle($_html)
  
=======

	public function __construct(){}
	
	public function __destruct(){}
	
	public function showArticle($_html)
	{

		$connec = new MDBase();
		global $data_article;
		global $data_assoc;
		global $data_theme;
		global $data_idUserList;

		if(isset($_GET['idA']))
		{
			$state = $connec->prepare(
				'SELECT U.ID
				FROM USER U, ASSOCIATION A, POST P
				WHERE WRITER_ID = U.ID
				AND A.ID = :idA
				AND U.ASSOCIATION_ID = A.ID'
				);
			$state->bindValue('idA', htmlspecialchars($_GET['idA']), PDO::PARAM_INT);
			$state->execute();
			$data_idUserList = $state->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			$data_idUserList = false;
		}


		// AFFICHAGE
		$state = $connec->prepare(
			"SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
			U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
			FROM   POST P, USER U
			WHERE  P.WRITER_ID = U.ID
			AND  P.PTYPE = 'ARTICLE'
			ORDER BY id DESC"
			);
		$state->execute();
		$data_article = $state->fetchAll(PDO::FETCH_ASSOC);

		$data_assoc = $connec->getAllAssocs();
		$data_theme = $connec->getAllThemes();

		// REMPLISSAGE DU CONTENU

		$vhtml = new VHtml();
		$vhtml->showHtml($_html);

	} // showShowArticle($_html)

>>>>>>> 856e7ca5ee8d7d6f3bcc2b5463fb4e201265ad80
} // VHtml
?>
