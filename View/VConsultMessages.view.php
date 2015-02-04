<?php
class VConsultMessages
{
  public function __construct(){}
  
  public function __destruct(){}
  
  public function showConsultMessages($path)
  {
  	$idUser = $_SESSION['ID_USER'];

  	global $connec;


    $state = $connec->prepare("SELECT M.*, U.NAME SENDER_NAME, U.SURNAME SENDER_SURNAME, C.NAME CATEGORY_NAME, T.NAME THEME_NAME
       FROM MESSAGES M, USER U, CATEGORY C, THEME T
       WHERE M.RECEIVER_ID = :idUser 
       AND M.SENDER_ID = U.ID
       AND C.ID = M.CATEGORY_ID
       AND T.ID = M.THEME_ID
       ORDER BY M.SENDDATE DESC");
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


    global $content_messages;
    $content_messages = "";

    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
        if($data_messages[$i]['ISARCHIVE'] == "0")
        {
            $content_messages .= '<tr id="message'.$data_messages[$i]['ID'].'" '; 
            if($data_messages[$i]['ISREADED'] == "0")
            {
                $content_messages .= ' class="notReaded" ';
            }
            $content_messages .= '>';


            $content_messages .= '<td class="currentTdMessage">'; 
            if($data_messages[$i]['ISREADED'] == "0")
            {
                $content_messages .= '<span class="label label-danger">Non-Lu</span>';
            }
            else
            {
                $content_messages .= '<span class="label label-success">Lu</span>';
            }
            echo '</td>';
            $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';
            $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['TITLE'];       
            $content_messages .= '<pre class="contentMessage">'.$data_messages[$i]['CONTENT'].'</pre></td>';        
            $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['CATEGORY_NAME'].'</td>';       
            $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['THEME_NAME'].'</td>';       
            $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDDATE'].'</td>';


            $content_messages .= '<td>
                <button title="Afficher" class="buttonShowMessages btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i></button>
                <div class="btnOptions">
                    <button title="Supprimer" class="buttonDeleteMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    <button title="Archiver" class="buttonArchivateMessages btn btn-sm btn-primary"><i class="glyphicon glyphicon-folder-open"></i></button>
                </div>
            </td>';       


            $content_messages .= '<tr />';
        }
    }

    global $content_messages_archive;
    $content_messages_archive = "";

    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
        if($data_messages[$i]['ISARCHIVE'] == "1")
        {
            $content_messages_archive .= '<tr id="message'.$data_messages[$i]['ID'].'" '; 
            if($data_messages[$i]['ISREADED'] == "0")
            {
                $content_messages_archive .= ' class="notReaded" ';
            }
            $content_messages_archive .= '>';
            

            $content_messages_archive .= '<td class="currentTdMessage">'; 
            if($data_messages[$i]['ISREADED'] == "0")
            {
                $content_messages_archive .= '<span class="label label-danger">Non-Lu</span>';
            }
            else
            {
                $content_messages_archive .= '<span class="label label-success">Lu</span>';
            }
            echo '</td>';
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['TITLE'];       
            $content_messages_archive .= '<pre class="contentMessage">'.$data_messages[$i]['CONTENT'].'</pre></td>';        
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['CATEGORY_NAME'].'</td>';       
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['THEME_NAME'].'</td>';          
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDDATE'].'</td>';
            

            $content_messages_archive .= '<td>
                <button title="Afficher" class="buttonShowMessages btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i></button>
                <div class="btnOptions">
                    <button title="Supprimer" class="buttonDeleteMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    <button title="Annuler l\'archive" class="buttonUnArchivateMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-folder-open"></i></button>
                </div>
            </td>';       


            $content_messages_archive .= '<tr />';
        }
    }

    global $data_theme;
    global $data_category;
    $mMod = new MDBase();
    $data_theme = $mMod->getAllThemes();
    $data_category = $mMod->getAllCategories();



$vhtml = new VHtml();
$vhtml->showHtml($path);

  } // showConsultMessages($_html)
  
} // VHtml
?>