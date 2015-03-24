<?php

	  class MShowArticle
    {
        function __construct ($id = null) {
            //connection à la base
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM POST WHERE ID = :id;"); // requete à effectuer
            $state->bindValue('id', $id, PDO::PARAM_INT); //le :id de la requete n'a aucune valeur, on lui bind alors celle de
            $state->execute();                            //$id (parametre du contructeur). On éxécute ensuite la requête
            $report = $state->fetch(PDO::FETCH_ASSOC);    //On récupère le résultat sous forme de tableau dans la variable $report
            /*
                PDO::FETCH_ASSOC permet de récuperer les résultats sous forme de tableau, on accede donc aux élément avec des []
                PDO::FETCH_OBJECT permet de récuperer les résultats sous forme d'objets, on accede donc aux élément avec des ->
            */
        }

        public function __destruct(){}



        public function countArticle($assoc, $theme){

            $pdo = new MDBase();

			//On compte tous les articles
			$pdo->connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "SELECT count(P.ID) AS NB_ARTICLE
					    FROM POST P, USER U
					   WHERE P.WRITER_ID = U.ID
					     AND P.PTYPE = 'ARTICLE'
		         		 AND P.STATUS > 0";

			if($assoc != -1)
		    	$query .= " AND U.ASSOCIATION_ID = :idAssoc ";
		    
		    if($theme != -1)
		    	$query .= " AND P.THEME_ID = :idTheme ";

		    $query .= "  AND DATEDIFF(CURDATE(), P.PDATE) <= 366";

			$qq = $pdo->prepare($query);

			if($assoc != -1)
				$qq->bindValue('idAssoc', $assoc, PDO::PARAM_INT);

			if($theme != -1)
				$qq->bindValue('idTheme', $theme, PDO::PARAM_INT);

			$qq->execute();
			$data = $qq->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

        public function displayArticle($currentPage, $perPage, $assoc, $theme){

        	$pdo = new MDBase();

			//On recupere tous les articles et on les affiche
			$pdo->connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "SELECT P.*, DATE_FORMAT(P.PDATE, '%d/%m/%Y') AS PDATE,
							 DATEDIFF(CURDATE(), P.PDATE) AS DUR_EXISTENCE,
					         U.NAME, U.SURNAME, U.ASSOCIATION_ID ASSOC_ID
					    FROM POST P, USER U
					   WHERE P.WRITER_ID = U.ID
					     AND P.PTYPE = 'ARTICLE'
		         		 AND P.STATUS > 0 ";
		    
		    if($assoc != -1)
		    	$query .= " AND U.ASSOCIATION_ID = :idAssoc ";
		    
		    if($theme != -1)
		    $query .= " AND P.THEME_ID = :idTheme ";

		    $query .= " AND DATEDIFF(CURDATE(), P.PDATE) <= 366
				   ORDER BY P.PDATE DESC
				      LIMIT :STARTPAGE, :PERPAGE ";
			
			$qq = $pdo->prepare($query);

			if($assoc != -1)
				$qq->bindValue('idAssoc', $assoc, PDO::PARAM_INT);

			if($theme != -1)
				$qq->bindValue('idTheme', $theme, PDO::PARAM_INT);

            $qq->bindValue('STARTPAGE', ($currentPage-1)*$perPage, PDO::PARAM_INT);
            $qq->bindValue('PERPAGE', $perPage, PDO::PARAM_INT);

			$qq->execute();
			$data = $qq->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		function deleteOldArticle() {

        	$pdo = new MDBase();

        	$pdo->connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$query = "DELETE FROM POST
			   		  WHERE DATEDIFF(CURDATE(), PDATE) > 365";
			$pdo->prepare($query);
			$pdo->execute();
		}
	}
?>