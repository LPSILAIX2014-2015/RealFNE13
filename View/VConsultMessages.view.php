<?php
class VConsultMessages
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showConsultMessages($path)
  {
  	//Simulation de marchage
  	//$idUser = $_SESSION['idUser'];
  	$idUser = 2;

  	global $connec;
    

    $state = $connec->prepare("SELECT MESSAGES.*, USER.NAME SENDER_NAME, USER.SURNAME SENDER_SURNAME  FROM MESSAGES, USER WHERE RECEIVER_ID = :idUser AND MESSAGES.SENDER_ID = USER.ID");
    $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
    $state->execute();    
    $data_messages = $state->fetchAll(PDO::FETCH_ASSOC);
  	
    /* REMPLISSAGATION DU CONTENU */


    global $content_messages;
    $content_messages = "";

    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
    	$content_messages .= '<tr>';

		$content_messages .= '<td>'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';    	
		$content_messages .= '<td>'.$data_messages[$i]['TITLE'].'</td>';    	
		$content_messages .= '<td><a class="btn-sm btn-warning"><i class="glyphicon glyphicon-plus"></i></a></td>';    	


    	$content_messages .= '<tr />';
    }


    /* REMPLISSAGATION DU CONTENU */

    $vhtml = new VHtml();
    $vhtml->showHtml($path);
    
  } // showConsultMessages($_html)
  
} // VHtml
?>