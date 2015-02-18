<?php

class MNotification {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }

    public function sendNotificationToUser($receiver_id, $content) {

        $this->sql->beginTransaction();
        $state = $this->sql->prepare("INSERT INTO notification (
            RECEIVER_ID,
            CONTENT,
            NDATE
            ) VALUES (
            :RECEIVER_ID,
            :CONTENT,
            NOW()
            )");


        $state->bindValue('RECEIVER_ID', $receiver_id, PDO::PARAM_INT);
        $state->bindValue('CONTENT', $content, PDO::PARAM_STR);
        $state->execute();    

        $idCreated = $this->sql->lastInsertId();
        $this->sql->commit();        

        return $idCreated;
    }

    public function sendNotificationToAllUsers($content) {

        $mDBase = new MDBase();
        $users = $mDBase->getAllUsers();
        for($i = 0 ; $i < count($users) ; ++$i)
        {
            $this->sendNotificationToUser($users[$i]['ID'], $content);
        }
        return true;
    }

    public function sendNotificationToAssoUsers($idAsso, $content) {

        $mDBase = new MDBase();
        $users = $mDBase->getAllUsers();
        for($i = 0 ; $i < count($users) ; ++$i)
        {
            if($users[$i]['ASSOCIATION_ID'] == $idAsso)
            {
                $this->sendNotificationToUser($users[$i]['ID'], $content);
            }
        }
        return true;
    }

    public function getNotificationByIdUser($id) {

        $this->sql->beginTransaction();
        $state = $this->sql->prepare("SELECT * FROM notification WHERE RECEIVER_ID = :id");

        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();    

        $results = $state->fetchAll(PDO::FETCH_ASSOC);
        $this->sql->commit();

        for($i = 0 ; $i < count($results) ; ++$i)
        {
            $date = $results[$i]["NDATE"];
            $date = explode('-', $date);
            

            $currentDate = $date[2].'/'.$date[1].'/'.$date[0];
            $results[$i]["NDATE"] = $currentDate; 
        }

        return $results;
    }

    public function displayNotification($data_notif) {

        $content_notif = "";


        for($i = 0 ; $i < count($data_notif) ; ++$i)
        {
            $content_notif .= '<tr class="lineNotif" id="notif'.$data_notif[$i]['ID'].'">';            
            $content_notif .= '<td class="currentTdNotif">'.$data_notif[$i]['CONTENT'].'</td>';
            $content_notif .= '<td class="currentTdNotif">'.$data_notif[$i]['NDATE'].'</td>';
            $content_notif .= '
            <td>
                <button title="Supprimer" class="buttonDeleteNotif">Supprimer</button>
            </td>';
            $content_notif .= '<tr />';

        }
        return $content_notif;
    }
}