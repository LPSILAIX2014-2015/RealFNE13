<?php
/**
 * @author <loubna EL MARNAOUIi>
 */
$sql = new MDBase();
	$query = "SELECT DISTINCT ID, TITLE, PDATE FROM POST WHERE STATUS=1 AND DATE_BEGIN IS NOT NULL ORDER BY(PDATE) DESC";

	$resultatultquery = $sql->prepare($query);

	$resultatultquery->execute();

	$resultat = $resultatultquery->fetchAll(PDO::FETCH_ASSOC);
	$dateArticle = "";
	for ($i=0; $i < count($resultat); $i++) { 
		$date = explode("-", $resultat[$i]['PDATE']);
		switch ($date[1]) {
			case '1': case '01': $month = 'Jan'; break;
			case '2': case '02': $month = 'Fév'; break;
			case '3': case '03': $month = 'Mar'; break;
			case '4': case '04': $month = 'Avr'; break;
			case '5': case '05': $month = 'Mai'; break;
			case '6': case '06': $month = 'Jui'; break;
			case '7': case '07': $month = 'Juil'; break;
			case '8': case '08': $month = 'Août'; break;
			case '9': case '09': $month = 'Sep'; break;
			case '10': $month = 'Oct'; break;
			case '11': $month = 'Nov'; break;
			case '12': $month = 'Déc'; break;
			default: echo "error"; break;
		}
		$dateArticle.="<li><a href='index.php?EX=showInfoArticle&id=".$resultat[$i]['ID']."'><span class='dateevent'>".$date[2]." ".$month."</span> ".$resultat[$i]['TITLE']."</a></li>";
	}
?>

<div class="nextevents">
    <h5 class="titrecol">Prochainement</h5>
    <ul>
 		 <?= $dateArticle;?>
    </ul>
</div>