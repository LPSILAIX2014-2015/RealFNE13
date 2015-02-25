<?php
/**
 * @author <Julien Bénard>
 * 
 * @author [Cesar Hernandez] 
 */
	$sql = new MDBase();
	$query = "SELECT DISTINCT SUBSTRING(PDATE,1,7)DATE FROM WHERE STATUS=1 POST ORDER BY(DATE) DESC";

	$result = $sql->prepare($query);

	$result->execute();
	$res = $result->fetchAll(PDO::FETCH_ASSOC);
	$realDate = "";
	for ($i=0; $i < count($res); $i++) { 
		$date = explode("-", $res[$i]['DATE']);
		switch ($date[1]) {
			case '1': case '01': $month = 'Janvier'; break;
			case '2': case '02': $month = 'Février'; break;
			case '3': case '03': $month = 'Mars'; break;
			case '4': case '04': $month = 'Avril'; break;
			case '5': case '05': $month = 'Mai'; break;
			case '6': case '06': $month = 'Juine'; break;
			case '7': case '07': $month = 'Juillet'; break;
			case '8': case '08': $month = 'Août'; break;
			case '9': case '09': $month = 'September'; break;
			case '10': $month = 'October'; break;
			case '11': $month = 'Novembre'; break;
			case '12': $month = 'Décembre'; break;
			default: echo "error"; break;
		}
		$realDate.="<li><a href='index.php?EX=genNL&data=".$res[$i]['DATE']."'>".$month." ".$date[0]."</a></li>";
	}
?>
<div class="linksnewsletters">
    <h5 class="titrecol">Newsletters</h5>
    <ul>
        <?= $realDate;?>
    </ul>
</div>