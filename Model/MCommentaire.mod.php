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
            $results[$i]["COM_DATE"] = $dateFormat->format('d/m/Y h:i:s');
        }

        return $results;
    }

    public function addCommentairePost($idPost, $content) {
        $state = $this->sql->prepare("INSERT INTO COMMENTAIRE(WRITER_ID,POST_ID,CONTENT,COM_DATE) VALUES (:ID,:ID_POST,:CONTENT,:COM_DATE)");

        $state->bindValue('ID', $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->bindValue('ID_POST', $idPost, PDO::PARAM_INT);
        $state->bindValue('CONTENT', $content, PDO::PARAM_STR);
        $state->bindValue('COM_DATE', date('d/m/Y h:i:s'), PDO::PARAM_STR);
        return $state->execute();
    }
}