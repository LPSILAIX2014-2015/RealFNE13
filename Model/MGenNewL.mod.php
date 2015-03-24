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
		$this->SetFillColor(75, 201, 226);
		$this->Rect(0, 0, 210, 30, 'F');
		$this->Image('./Img/headerbg.png',150,0,60,30);
		//$this->Image('./Img/logo.png',12,7);
		$this->SetFont('Arial','B',20);
		$this->setTextColor(244,244,244);
		$this->Cell(0,-10, utf8_decode('Newsletter de '.$this->month." ".$this->mYear[0]),0,1,'C');
		$this->SetFont('Arial','B',15);
		$this->Cell(0,20, utf8_decode('La Plateforme FNE13'),0,1,'C');
		$this->Ln(4);
	}
	/**
	 * [Footer Creation du pied page personalisé]
	 */
	function Footer()
	{
		$this->SetFillColor(51, 122, 183);
		$this->Rect(0, 287, 210, 10, 'F');
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->setTextColor(255,255,255);
		$this->Cell(0,20,'Page '.$this->PageNo().' sur {nb}',0,0,'C');
	}
	/**
	 * [searchInfo Mèthode pour obtenir l'information par le newsletter]
	 * @param  $assoN [Nom de la association]
	 * @return [L'information triée par asso et date]
	 */
	function searchInfo($assoN){
		$sql = new MDBase();
	    $query = "SELECT POST.ID POST_ID,TITLE,PDATE,CONTENT,POST.IMAGEPATH, USER.NAME USER_NAME, ASSOCIATION.NAME ASSO_NAME, THEME.NAME TNAME
	    	FROM POST INNER JOIN USER ON POST.WRITER_ID=USER.ID INNER JOIN ASSOCIATION ON USER.ASSOCIATION_ID=ASSOCIATION.ID 
	    	INNER JOIN THEME ON POST.THEME_ID=THEME.ID
	    	WHERE SUBSTRING(PDATE,1,7)='".$this->get['data']."' 
	    	AND STATUS=1 AND PTYPE='ARTICLE' AND ASSOCIATION.NAME='$assoN' ORDER BY ASSOCIATION.NAME, PDATE DESC LIMIT 3";

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
		$this->SetMargins(15, 20 , 15); 

		# Nous etablisons le margin en bas
		$this->SetAutoPageBreak(true,20);
		$this->AliasNbPages();
		$this->AddPage();
		# Entete 
		$this->SetFont('Times','B',14);
		$this->setTextColor(20,79,152);

		$this->Cell(0,5,utf8_decode("Ceux-ci sont les articles les plus récents dans la plateforme : "),0,1,'C');
		$this->Ln();
		for ($a=0; $a < count($unique); $a++) {
			# Data
			$dataN = $this->searchInfo($unique[$arrayID[$a]]);
			$this->SetFont('Times','B',16);
			$this->setTextColor(20,79,255);
			$this->Cell(0,5,utf8_decode("Association : ".$unique[$arrayID[$a]]),0,1,'C');
			$this->Ln();

			for ($b=0; $b < count($dataN); $b++) { 
				if ($dataN[$b]['IMAGEPATH']=='' || $dataN[$b]['IMAGEPATH']==null || !file_exists($dataN[$b]['IMAGEPATH'])) {
					# Image
					$this->Image('./Img/no-image.gif', $this->GetX(), $this->GetY()+3,30,30,'', 'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
					# Space
					$this->setX(47);
					$this->Cell(0,5,"",'LRT',1,'L');
					# Title
					$this->setX(47);
					$this->SetFont('Times','B',16);
					$this->setTextColor(178,54,112);
					$this->Cell(0,5,utf8_decode($dataN[$b]['TITLE']),'LR',2,'L',false, 'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
				    # Author et Asso
				    $this->setX(47);
					$this->SetFont('Times','I',10);
					$this->setTextColor(130,120,225);
					$this->Cell(0,5,utf8_decode("Écrit par : ".$dataN[$b]['USER_NAME']." - ".$dataN[$b]['ASSO_NAME']." le ".date("d-m-Y",strtotime($dataN[$b]['PDATE']))),'LR',2,'L');
					# Theme
					$this->setX(47);
					$this->Cell(0,5,utf8_decode("Thematique: ".$dataN[$b]['TNAME']),'LR',1,'L');
					# Content
					$this->setX(47);
					$this->SetFont('Times','',12);
					$this->setTextColor(101,101,101);

					$this->MultiCell(0,5,strip_tags(html_entity_decode(utf8_decode($dataN[$b]['CONTENT']))),'LR');

					# Link
					$this->setX(47);
					$this->SetFillColor(163, 207, 234);
					$this->SetFont('Times','B',11);
					$this->setTextColor(12,80,145);
					$this->Cell(0,5,utf8_decode("Afficher sur le site web ->").$this->Rect($this->GetX(), $this->GetY(), 45, 5, 'F'),'LR',1,'L',false,'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
					$this->setX(47);
					$this->Cell(0,5,"",'LRB',1,'L');
					# Space Line
					$this->Image('./Img/separator.png', 36, null,150);
					$this->Ln();
				} else {
					# Image
					$this->Image($dataN[$b]['IMAGEPATH'], $this->GetX(), $this->GetY()+3,30,30,'', 'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
					# Space
					$this->setX(47);
					$this->Cell(0,5,"",'LRT',1,'L');
					# Title
					$this->setX(47);
					$this->SetFont('Times','B',16);
					$this->setTextColor(178,54,112);
					$this->Cell(0,5,utf8_decode($dataN[$b]['TITLE']),'LR',2,'L',false, 'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
				    # Author et Asso
				    $this->setX(47);
					$this->SetFont('Times','I',10);
					$this->setTextColor(130,120,225);
					$this->Cell(0,5,utf8_decode("Écrit par : ".$dataN[$b]['USER_NAME']." - ".$dataN[$b]['ASSO_NAME']." le ".date("d-m-Y",strtotime($dataN[$b]['PDATE']))),'LR',2,'L');
					# Theme
					$this->setX(47);
					$this->Cell(0,5,utf8_decode("Thematique: ".$dataN[$b]['TNAME']),'LR',1,'L');
					# Content
					$this->setX(47);
					$this->SetFont('Times','',12);
					$this->setTextColor(101,101,101);
					$this->MultiCell(0,5,strip_tags(html_entity_decode(utf8_decode($dataN[$b]['CONTENT']))),'LR');
					# Link
					$this->setX(47);
					$this->SetFillColor(163, 207, 234);
					$this->SetFont('Times','B',11);
					$this->setTextColor(12,80,145);
					$this->Cell(0,5,utf8_decode("Afficher sur le site web ->").$this->Rect($this->GetX(), $this->GetY(), 45, 5, 'F'),'LR',1,'L',false,'http://laplateformefne13.fr/index.php?EX=showInfoArticle&id='.$dataN[$b]['POST_ID']);
					$this->setX(47);
					$this->Cell(0,5,"",'LRB',1,'L');
					# Space Line
					$this->Image('./Img/separator.png', 36, null,150);
					$this->Ln();
				}
			}
		}			
		$this->Output("Newsletter-".$this->month." ".$this->mYear[0].".pdf",'D');
	}
}

 ?>