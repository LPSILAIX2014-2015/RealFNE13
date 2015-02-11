<?php

class MConsultMessage {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }

    public function getAllMessagesByIdUser($idUser) {

        $state = $this->sql->prepare("SELECT M.*, U.NAME SENDER_NAME, U.SURNAME SENDER_SURNAME, C.NAME CATEGORY_NAME, T.NAME THEME_NAME
         FROM MESSAGE M, USER U, MESCAT C, THEME T
         WHERE M.RECEIVER_ID = :idUser 
         AND M.SENDER_ID = U.ID
         AND C.ID = M.CAT_ID
         AND T.ID = M.THEME_ID
         ORDER BY M.SENDDATE DESC");
        $state->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetchAll(PDO::FETCH_ASSOC);
        for($i = 0 ; $i < count($results) ; ++$i)
        {
            $date = $results[$i]["SENDDATE"];
            $date = explode('-', $date);
            

            $currentDate = $date[2].'/'.$date[1].'/'.$date[0];
            $results[$i]["SENDDATE"] = $currentDate; 
        }

        return $results;
    }

    public function displayMessages($data_messages) {

        $content_messages = "";

        for($i = 0 ; $i < count($data_messages) ; ++$i)
        {
            if($data_messages[$i]['ISARCHIVE'] == "0")
            {
                $content_messages .= '<tr id="message'.$data_messages[$i]['ID'].'" '; 
                if($data_messages[$i]['ISREAD'] == "0")
                {
                    $content_messages .= ' class="notReaded" ';
                }
                $content_messages .= '>';


                $content_messages .= '<td class="currentTdMessage">'; 
                if($data_messages[$i]['ISREAD'] == "0")
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

    return $content_messages;
}

public function displayMessagesArchive($data_messages) {

    $content_messages_archive = "";
    
    for($i = 0 ; $i < count($data_messages) ; ++$i)
    {
        if($data_messages[$i]['ISARCHIVE'] == "1")
        {
            $content_messages_archive .= '<tr id="message'.$data_messages[$i]['ID'].'" '; 
            if($data_messages[$i]['ISREAD'] == "0")
            {
                $content_messages_archive .= ' class="notReaded" ';
            }
            $content_messages_archive .= '>';


            $content_messages_archive .= '<td class="currentTdMessage">'; 
            if($data_messages[$i]['ISREAD'] == "0")
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


            $content_messages_archive .= '
            <td>
                <button title="Afficher" class="buttonShowMessages btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i></button>
                <div class="btnOptions">
                    <button title="Supprimer" class="buttonDeleteMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    <button title="Annuler l\'archive" class="buttonUnArchivateMessages btn btn-sm btn-danger"><i class="glyphicon glyphicon-folder-open"></i></button>
                </div>
            </td>';       


            $content_messages_archive .= '<tr />';
        }
        return $content_messages_archive;
    }
}


}