<?php

class MCommentaire {

    private $sql;

    function __construct () {
        $this->sql = new MDBase();
    }

    public function getCommentairePost($idPost) {

        $state = $this->sql->prepare("SELECT C.*, U.NAME, U.SURNAME
         FROM COMMENTAIRE C, USER U
         WHERE POST_ID = :idPost AND C.WRITER_ID = U.ID");

        $state->bindValue('idPost', $idPost, PDO::PARAM_INT);
        $state->execute();    
        $results = $state->fetchAll(PDO::FETCH_ASSOC);

        for($i = 0 ; $i < count($results) ; ++$i)
        {
            $date = $results[$i]["COM_DATE"];
            $dateFormat = new DateTime($date);
            $results[$i]["COM_DATE"] = $dateFormat->format('d/m/Y H:i:s');

            $lastEdit = $results[$i]["LAST_EDITION"];
            $lastEditFormat = new DateTime($lastEdit);
            $results[$i]["LAST_EDITION"] = $lastEditFormat->format('d/m/Y H:i:s');
        }

        return $results;
    }

    public function addCommentairePost($idPost, $content) {
        
        $state = $this->sql->prepare("INSERT INTO COMMENTAIRE(WRITER_ID,POST_ID,CONTENT,COM_DATE) VALUES (:WRITER_ID,:ID_POST,:CONTENT,NOW())");


        $state->bindValue('WRITER_ID', $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->bindValue('ID_POST', $idPost, PDO::PARAM_INT);
        $state->bindValue('CONTENT', $content, PDO::PARAM_STR);
        return $state->execute();
    }

    public function deleteCommentaire($idcom) {
        $state = $this->sql->prepare("DELETE FROM COMMENTAIRE WHERE ID = :ID");

        $state->bindValue('ID', $idcom, PDO::PARAM_INT);
        return $state->execute();
    }

    public function updateCommentaire($idcom, $content) {
        $state = $this->sql->prepare("UPDATE COMMENTAIRE 
                                      SET CONTENT = :CONTENT,
                                          LAST_EDITION = :LAST_EDITION
                                      WHERE ID = :ID ");

        $state->bindValue('ID',      $idcom, PDO::PARAM_INT);
        $state->bindValue('CONTENT', $content, PDO::PARAM_STR);
        $state->bindValue('LAST_EDITION', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        return $state->execute();
    }
}