<?php

    require '../Model/MDBase.mod.php';
    require '../Model/MShowArticle.mod.php';

    session_start();

    $connect = new MShowArticle();

    switch($_POST['role']){

    	case "consultArticle":
    		$total = $connect->countArticle($_POST['assoc'], $_POST['theme']); 					    // Nombre total de résultat
    		$perPage = 2;                   						// Nombre de resultat par page
    		$nbPage = ceil($total[0]['NB_ARTICLE'] / $perPage); 	// Nombre de page total (ceil permet d'arrondir au nombre supérieur)

    		if(isset($_GET['p']) AND $_GET['p'] > 0 AND $_GET['p'] <= $nbPage)
    		    $currentPage = $_GET['p'];    				// Page courante initialser avec le parametre de la fonction
    		else
    		    $currentPage = 1;            				// Page courante initialiser à 1 par défaut


            //$result = $connect->diplayArticle($currentPage, $perPage);
            $result = $connect->displayArticle($currentPage, $perPage, $_POST['assoc'], $_POST['theme']);
            for($i = 0 ; $i < count($result) ; ++$i)
            {
                html_entity_decode($result[$i]['CONTENT']); // interprète les balises HTML de la description

                if(strlen($result[$i]['CONTENT']) > 250) {
                    // [SLaaa] est un repère qui permet, en le substituant, de placer des balise <p> et <br /> pour les sauts de ligne
                    str_replace('<br />', '[SLaaa]', $result[$i]['CONTENT']);
                    str_replace('</p>', '[SLaaa]', $result[$i]['CONTENT']);
                    substr(strip_tags($result[$i]['CONTENT']), 0, 250);
                    str_replace('[SLaaa]', '<br />', $result[$i]['CONTENT']);    
                }
            }


	    	$jsonarray = array("article" => $result, "page" => $currentPage, "nbPage" => $nbPage);
			$jsonReturned = json_encode($jsonarray);
			echo $jsonReturned;
		break;

    }
    
?>