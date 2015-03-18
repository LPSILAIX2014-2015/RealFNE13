<?php
class VShowArticle
{
<<<<<<< HEAD

=======
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
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
<<<<<<< HEAD
				 FROM   USER U, ASSOCIATION A, POST P
				 WHERE  WRITER_ID = U.ID
           AND  A.ID = :idA
           AND  U.ASSOCIATION_ID = A.ID'
	   	);
=======
				FROM USER U, ASSOCIATION A, POST P
				WHERE WRITER_ID = U.ID
				AND A.ID = :idA
				AND U.ASSOCIATION_ID = A.ID'
				);
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
			$state->bindValue('idA', htmlspecialchars($_GET['idA']), PDO::PARAM_INT);
			$state->execute();
			$data_idUserList = $state->fetchAll(PDO::FETCH_ASSOC);
		}
		else
		{
			$data_idUserList = false;
		}

<<<<<<< HEAD
		// AFFICHAGE
		$state = $connec->prepare(
			"SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
              DATEDIFF(CURDATE(), P.PDATE) AS DUR_EXISTENCE,
			        U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
			 FROM   POST P, USER U
			 WHERE  P.WRITER_ID = U.ID
			   AND  P.PTYPE = 'ARTICLE'
         AND  P.STATUS > 0
         AND  DATEDIFF(CURDATE(), P.PDATE) <= 366
			 ORDER BY id DESC"
=======

		// AFFICHAGE
		$state = $connec->prepare(
			"SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
			U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
			FROM   POST P, USER U
			WHERE  P.WRITER_ID = U.ID
			AND  P.PTYPE = 'ARTICLE'
			ORDER BY id DESC"
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
			);
		$state->execute();
		$data_article = $state->fetchAll(PDO::FETCH_ASSOC);

<<<<<<< HEAD
    $delete_old_article = $connec->prepare(
      "DELETE FROM POST
       WHERE DATEDIFF(CURDATE(), PDATE) > 365"
    );
    $delete_old_article->execute();

    $data_assoc = $connec->getAllAssocs();
=======
		$data_assoc = $connec->getAllAssocs();
>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
		$data_theme = $connec->getAllThemes();

		// REMPLISSAGE DU CONTENU

		$vhtml = new VHtml();
		$vhtml->showHtml($_html);

	} // showShowArticle($_html)
<<<<<<< HEAD
  
=======

>>>>>>> d8796ecf59917e517f4669fbd39c26d6b1bad59b
} // VHtml
?>
