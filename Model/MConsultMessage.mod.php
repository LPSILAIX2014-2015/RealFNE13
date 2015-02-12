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
                $content_messages .= '<tr  class="lineMessage'; 
                if($data_messages[$i]['ISREAD'] == "0")
                {
                    $content_messages .= ' notReaded';
                }
                $content_messages .= '" data-categ="'.$data_messages[$i]["CAT_ID"].'" data-theme="'.$data_messages[$i]["THEME_ID"].'" id="message'.$data_messages[$i]['ID'].'" '; 
                $content_messages .= '>';


                
                $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';
                $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['TITLE'];       
                $content_messages .= '<pre class="contentMessage">'.$data_messages[$i]['CONTENT'].'</pre></td>';        
                $content_messages .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDDATE'].'</td>';


                $content_messages .= '<td>
                <button title="Détail" data-bool="1" class="buttonShowMessages">Détail</button>
                <div class="btnOptions">
                    <button title="Supprimer" class="buttonDeleteMessages">Supprimer</button>
                    <button title="Archiver" class="buttonArchivateMessages">Archiver</button>
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
            $content_messages_archive .= '<tr  class="lineMessage'; 
            if($data_messages[$i]['ISREAD'] == "0")
            {
                $content_messages_archive .= ' notReaded ';
            }
            $content_messages_archive .= '" data-categ="'.$data_messages[$i]["CAT_ID"].'" data-theme="'.$data_messages[$i]["THEME_ID"].'" id="message'.$data_messages[$i]['ID'].'" '; 
            $content_messages_archive .= '>';


            
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDER_NAME'].' '.$data_messages[$i]['SENDER_SURNAME'].'</td>';
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['TITLE'];       
            $content_messages_archive .= '<pre class="contentMessage">'.$data_messages[$i]['CONTENT'].'</pre></td>';        
            $content_messages_archive .= '<td class="currentTdMessage">'.$data_messages[$i]['SENDDATE'].'</td>';


            $content_messages_archive .= '
            <td>
                <button title="Détail" data-bool="1" class="buttonShowMessages">Détail</button>
                <div class="btnOptions">
                    <button title="Supprimer" class="buttonDeleteMessages">Supprimer</button>
                    <button title="Annuler l\'archive" class="buttonUnArchivateMessages">Rétablir</button>
                </div>
            </td>';       


            $content_messages_archive .= '<tr />';
        }


    }
    return $content_messages_archive;
}


}