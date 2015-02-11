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
            PDATE
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
        echo "<pre>";
        var_dump($users);
        echo "</pre>";
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

}