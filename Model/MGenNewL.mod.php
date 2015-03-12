<?php 
/**
 * @author Cesar Hernandez <[Mex]>
 */
class MGenNewL extends FPDF
{	
	/**
	 * [Header Creation du êntete du document personalisé]
	 */
	function Header()
	{
		$this->Image('./Img/logo.png',20,16);
		$this->SetFont('Arial','B',20);
		$this->setTextColor(0,0,0);
		$this->Cell(35);
		$this->Cell(100,10, utf8_decode('Newsletter de '.$this->month." ".$this->mYear[0]),0,1,'C');
		$this->SetFont('Arial','B',15);
		$this->Cell(0,10, utf8_decode('La Plateforme FNE13'),0,1,'C');
		$this->Ln(4);
	}
	/**
	 * [Footer Creation du pied page personalisé]
	 */
	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->setTextColor(0,0,0);
		$this->Cell(0,10,'Page '.$this->PageNo().' de {nb}',0,0,'C');
	}
	/**
	 * [searchInfo Mèthode pour obtenir l'information par le newsletter]
	 * @param  $assoN [Nom de la association]
	 * @return [L'information triée par asso et date]
	 */
	function searchInfo($assoN){
		$sql = new MDBase();
	    $query = "SELECT POST.ID POST_ID,TITLE,PDATE,CONTENT,POST.IMAGEPATH, USER.NAME USER_NAME, ASSOCIATION.NAME ASSO_NAME
	    	FROM POST INNER JOIN USER ON POST.WRITER_ID=USER.ID INNER JOIN ASSOCIATION ON USER.ASSOCIATION_ID=ASSOCIATION.ID 
	    	WHERE SUBSTRING(PDATE,1,7)='".$this->get['data']."' 
	    	AND STATUS=1 AND PTYPE='ARTICLE' AND ASSOCIATION.NAME='$assoN' ORDER BY ASSOCIATION.NAME, PDATE DESC LIMIT 2";

	    $result = $sql->prepare($query);

	    $result->execute();
	    return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * [searchAssos Mèthode pour obtenir le nom de tous les assos qui ont publié dans le date établi]
	 * @return [type] [Liste des assos]
	 */
	function searchAssos(){
		$sql = new MDBase();
	    $query = "SELECT PDATE, ASSOCIATION.NAME ASSO_NAME
	    	FROM POST INNER JOIN USER ON POST.WRITER_ID=USER.ID INNER JOIN ASSOCIATION ON USER.ASSOCIATION_ID=ASSOCIATION.ID 
	    	WHERE SUBSTRING(PDATE,1,7)='".$this->get['data']."' AND STATUS=1 AND PTYPE='ARTICLE' ORDER BY ASSO_NAME, PDATE DESC";
	    $result = $sql->prepare($query);
	    $result->execute();
	    return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	/**
	 * [setDate Creation de la date personalisé]
	 * @param [type] $date [La date pour generer le newsletter]
	 */
	function setDate($date){
		$this->get=$date;
		$this->mYear = explode("-", $date['data']);
		switch ($this->mYear[1]) {
			case '1': case '01': $this->month = 'Janvier'; break;
			case '2': case '02': $this->month = 'Février'; break;
			case '3': case '03': $this->month = 'Mars'; break;
			case '4': case '04': $this->month = 'Avril'; break;
			case '5': case '05': $this->month = 'Mai'; break;
			case '6': case '06': $this->month = 'Juine'; break;
			case '7': case '07': $this->month = 'Juillet'; break;
			case '8': case '08': $this->month = 'Août'; break;
			case '9': case '09': $this->month = 'September'; break;
			case '10': $this->month = 'October'; break;
			case '11': $this->month = 'Novembre'; break;
			case '12': $this->month = 'Décembre'; break;
			default: echo "error"; break;
		}
	}
	/**
	 * [generate Genere le newletter avec l'info requise]
	 * @return [document PDF] [Creation du document téléchargable]
	 */
	function generate(){
		$nData = $this->searchAssos();

		for ($i=0; $i < count($nData); $i++) { 
			$asso[$i]= $nData[$i]['ASSO_NAME'];
		}
		$unique = array_unique($asso);
		$arrayID = array_keys($unique);
		# Nous etablisons les margins (haut, gauche et droite)
		$this->SetMargins(25, 20 , 25); 

		# Nous etablisons le margin en bas
		$this->SetAutoPageBreak(true,20);
		$this->AliasNbPages();
		$this->AddPage();
		# Entete 
		$this->SetFont('Times','B',16);
		$this->setTextColor(20,79,152);
		$this->Cell(0,5,utf8_decode("Ceux-ci sont les articles les plus récents dans la plateforme : "),0,1,'L');
		$this->Ln();
		for ($a=0; $a < count($unique); $a++) {
			# Data
			$dataN = $this->searchInfo($unique[$arrayID[$a]]);
			
			for ($b=0; $b < count($dataN); $b++) { 
				if ($dataN[$b]['IMAGEPATH']=='' || $dataN[$b]['IMAGEPATH']==null) {
					# Title
					$this->SetFont('Times','B',16);
					$this->setTextColor(178,54,112);
					$this->Cell(0,7,utf8_decode($dataN[$b]['TITLE']),0,1,'C');
					$this->Ln();
					# Image
						$this->Image('./Img/logo.png', 90, null, 30, 30);
				    # Author et Asso
					$this->SetFont('Times','I',9);
					$this->setTextColor(130,120,225);
					$this->Cell(0,5,utf8_decode("Écrit par : ".$dataN[$b]['USER_NAME']." - ".$dataN[$b]['ASSO_NAME']." le ".date("d-m-Y",strtotime($dataN[$b]['PDATE']))),0,1,'C');
					$this->Ln();
					# Content
					$this->SetFont('Times','',12);
					$this->setTextColor(101,101,101);
					$this->MultiCell(0,5,$dataN[$b]['CONTENT']);
					$this->Ln();
				} else {
					# Title
					$this->SetFont('Times','B',16);
					$this->setTextColor(178,54,112);
					$this->Cell(0,7,utf8_decode($dataN[$b]['TITLE']),0,1,'C');
					$this->Ln();
					# Image
					$this->Image($dataN[$b]['IMAGEPATH'], 90, null, 30, 30);	
				    # Author et Asso
					$this->SetFont('Times','I',9);
					$this->setTextColor(130,120,225);
					$this->Cell(0,5,utf8_decode("Écrit par : ".$dataN[$b]['USER_NAME']." - ".$dataN[$b]['ASSO_NAME']." le ".date("d-m-Y",strtotime($dataN[$b]['PDATE']))),0,1,'C');
					$this->Ln();
					# Content
					$this->SetFont('Times','',12);
					$this->setTextColor(101,101,101);
					$this->MultiCell(0,5,$dataN[$b]['CONTENT']);
					$this->Ln();
				}
			}
		}			
		$this->Output("Newsletter-".$this->month." ".$this->mYear[0].".pdf",'D');
	}
}

 ?>