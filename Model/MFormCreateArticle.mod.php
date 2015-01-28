<?php
class MFormCreateArticle
{
    function __construct ($id = null) {
        $sql = new MDBase();
        $state = $sql->prepare("SELECT * FROM POST WHERE ID = :id;");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $report = $state->fetch(PDO::FETCH_ASSOC);
    }

    public function __destruct(){}

    public function insertDB($data){

        var_dump($_SESSION);

        $sql = new MDBase();
        //Get all data from inputs in $option
        $options = array(
            "articleTitle"      => FILTER_SANITIZE_SPECIAL_CHARS,
            "articleTheme"      => FILTER_SANITIZE_SPECIAL_CHARS,
            "eventPlace"        => FILTER_SANITIZE_SPECIAL_CHARS,
            "startDate"         => FILTER_SANITIZE_SPECIAL_CHARS,
            "duration"          => FILTER_VALIDATE_INT,
            "inscription"       => FILTER_SANITIZE_SPECIAL_CHARS,
            "textareaDecrypt"   => FILTER_SANITIZE_SPECIAL_CHARS
            );
        // Fill data form with $otpion (we can get the data of all input by using $dataForm["nameinput"]
        $dataForm = filter_input_array(INPUT_POST, $options);

        if($_SESSION['ID_USER'] == null) return;
        if(strlen($dataForm['articleTitle']) == 0) return;
        if(strlen($dataForm['articleTheme']) == 0) return;
        if(strlen($dataForm['textareaDecrypt']) == 0) return;

        $sql->beginTransaction();
        $state = $sql->prepare("INSERT INTO POST (
            WRITER_ID,
            TITLE,
            THEME,
            PLACE,
            PDATE,
            DURATION,
            INSCRIPTION,
            CONTENT,
            IMAGEPATH
            )
        VALUES (
            :WRITER_ID,
            :TITLE,
            :THEME,
            :PLACE,
            :PDATE,
            :DURATION,
            :INSCRIPTION,
            :CONTENT,
            :IMAGEPATH

            )
        ");
        //If the preparation went wrong, we rollBack (request canceled), and we return false 
        if(!$state) {
            $sql->rollBack();
            return false;
        }
        
        $state->bindValue('WRITER_ID',  $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->bindValue('TITLE',      $dataForm['articleTitle'], PDO::PARAM_STR);
        $state->bindValue('THEME',      $dataForm['articleTheme'], PDO::PARAM_STR);
        $state->bindValue('PLACE',      $dataForm['eventPlace'], PDO::PARAM_STR);
        $state->bindValue('PDATE',      $dataForm['startDate'], PDO::PARAM_STR);
        $state->bindValue('DURATION',   $dataForm['duration'], PDO::PARAM_INT);
        $state->bindValue('INSCRIPTION',$dataForm['inscription'], PDO::PARAM_INT);
        $state->bindValue('CONTENT',    $dataForm['textareaDecrypt'], PDO::PARAM_STR);
        $state->bindValue('IMAGEPATH', "/IMG/lol.png", PDO::PARAM_STR);

        $state->execute();

        $temp = $sql->lastInsertId();

        $sql->commit();

        return $temp;
    }

}
?>