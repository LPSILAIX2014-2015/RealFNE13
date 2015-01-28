<?php
class VConsultMessages
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showConsultMessages($path)
  {
  	$idUser = $_SESSION['ID_USER'];
    
  	global $connec;
    

    $state = $connec->prepare("SELECT MESSAGES.*, USER.NAME SENDER_NAME, USER.SURNAME SENDER_SURNAME
    							FROM MESSAGES, USER
    							WHERE RECEIVER_ID = :idUser 
    							AND MESSAGES.SENDER_ID = USER.ID
    							ORDER BY MESSAGES.SENDDATE DESC");
    $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
    $state->execute();    
    $data_messages = $state->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
    	$date = $data_messages[$i]["SENDDATE"];
    	$date = explode('-', $date);
    	

    	$currentDate = $date[2].'/'.$date[1].'/'.$date[0];
    	$data_messages[$i]["SENDDATE"] = $currentDate; 
    }
  	
    /* REMPLISSAGATION DU CONTENU */


    global $content_messages;
    $content_messages = "";

    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
    	$content_messages .= '<tr id="message'.$data_messages[$i]['ID'].'" '; 
    	if($data_messages[$i]['ISREADED'] == "0")
    	{
    		$content_messages .= ' class="notReaded" ';
    	}
    	$content_messages .= '>';
    	

		$content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';
		$content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['TITLE'];    	
		$content_messages .= '<pre class="contentMessage">'.$data_messages[$i]['CONTENT'].'</pre></td>';    	
		$content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDDATE'].'</td>';
    	

		$content_messages .= '<td>
            <button title="Afficher" class="buttonShowMessages btn btn-sm btn-warning"><i class="glyphicon glyphicon-plus"></i></button>
            <div class="btnOptions">
                <button title="Supprimer" class="buttonDeleteMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                <button title="Archiver" class="buttonArchivateMessages btn btn-sm btn-primary"><i class="glyphicon glyphicon-folder-open"></i></button>
            </div>
          </td>';    	


    	$content_messages .= '<tr />';
    }


    /* REMPLISSAGATION DU CONTENU */

    $vhtml = new VHtml();
    $vhtml->showHtml($path);
    
  } // showConsultMessages($_html)
  
} // VHtml
?>