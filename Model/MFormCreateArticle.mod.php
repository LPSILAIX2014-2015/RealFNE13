<?php
class MFormCreateArticle
{
    function __construct ($id = null) {
        $sql = new MDBase();
        $state = $sql->prepare("SELECT * FROM post WHERE ID = :id;");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $report = $state->fetch(PDO::FETCH_ASSOC);
    }

    public function __destruct(){}

    public function insertDB($data){

        $postDate = date('d/m/Y');
        /**
        
        Controle Image

        **/


       /* $repertoireDestination = dirname(__FILE__)."Img/ImgArticle/";

        $extensionsAutorisees = array("jpeg", "jpg","png");
        $nomOrigine = $_FILES["articleImage"]["name"];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];

        $maxImageSize = $_POST["max_file_size"];

        //Check if the file is an image
        if (in_array($extensionFichier, $extensionsAutorisees) {
            echo "Le fichier à le bon format";

            //Check if the size of the image is correct
            if($_FILES["articleImage"]["size"] < $maxImageSize){
    
            }

        //Check if the file is upload
        } else{
            echo "Ce type de fichier n'est pas autorisé";
            return;
        }

        




        if(is_uploaded_file($_FILES["articleImage"]["tmp_name"])) {

            //Check if the file is correctly moved
            if (rename($_FILES["articleImage"]["tmp_name"],$repertoireDestination.$_FILES["articleImage"]["name"])) {
                echo "Le fichier temporaire ".$_FILES["articleImage"]["tmp_name"]." a été déplacé vers ".$repertoireDestination.$_FILES["articleImage"]["name"];
            } else {
                echo "Le fichier n'a pas été uploadé (trop gros ?) ou le déplacement du fichier temporaire a échoué ou vérifiez l'existence du répertoire ".$repertoireDestination;
            }
        }*/



        /**
        
        Connexion sql

        **/

        $sql = new MDBase();
        //Get all data from inputs in $option
        $options = array(
            "articleTitle"      => FILTER_SANITIZE_SPECIAL_CHARS,
            "articleTheme"      => FILTER_VALIDATE_INT,
            "eventPlace"        => FILTER_SANITIZE_SPECIAL_CHARS,
            "startDate"         => FILTER_SANITIZE_SPECIAL_CHARS,
            "duration"          => FILTER_VALIDATE_INT,
            "inscription"       => FILTER_SANITIZE_SPECIAL_CHARS,
            "textareaDecrypt"   => FILTER_SANITIZE_SPECIAL_CHARS
        );

        // Fill data form with $otpion (we can get the data of all input by using $dataForm["nameinput"]
        $dataForm = filter_input_array(INPUT_POST, $options);


        if(!$dataForm['duration'])
        {
            $dataForm['duration'] = 0;
        }
        if(!$dataForm['inscription'])
        {
            $dataForm['inscription'] = 0;
        }
        
        if($_SESSION['ID_USER'] == null) return;
        if(strlen($dataForm['articleTitle']) == 0) return;
        if(strlen($dataForm['textareaDecrypt']) == 0) return;

        $sql->beginTransaction();
        $state = $sql->prepare("INSERT INTO post (
            WRITER_ID,
            TITLE,
            THEME_ID,
            PLACE,
            PTYPE,
            PDATE,
            DATE_BEGIN,
            DURATION,
            INSCRIPTION,
            CONTENT,
            IMAGEPATH,
            STATUS
            )
        VALUES (
            :WRITER_ID,
            :TITLE,
            :THEME_ID,
            :PLACE,
            :PTYPE,
            :PDATE,
            :DATE_BEGIN,
            :DURATION,
            :INSCRIPTION,
            :CONTENT,
            :IMAGEPATH,
            :STATUS
            )
        ");

        //If the preparation went wrong, we rollBack (request canceled), and we return false 
        var_dump($state);
        if(!$state) {
            $sql->rollBack();
            return false;
        }

        var_dump($postDate);
        
        var_dump($_SESSION['ID_USER']);

        var_dump($dataForm['articleTitle']);
        var_dump($dataForm['articleTheme']);
        var_dump($dataForm['eventPlace']);
        var_dump($dataForm['startDate']);
        var_dump($dataForm['duration']);
        var_dump($dataForm['inscription']);
        var_dump($dataForm['textareaDecrypt']);


        //Bind datavalue and databases fields. 
        $state->bindValue('WRITER_ID',  $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->bindValue('TITLE',      $dataForm['articleTitle'], PDO::PARAM_STR);
        $state->bindValue('THEME_ID',   $dataForm['articleTheme'], PDO::PARAM_INT);
        $state->bindValue('PLACE',      $dataForm['eventPlace'], PDO::PARAM_STR);
        $state->bindValue('DATE_BEGIN', $dataForm['startDate'], PDO::PARAM_STR);
        $state->bindValue('DURATION',   $dataForm['duration'], PDO::PARAM_INT);
        $state->bindValue('INSCRIPTION',$dataForm['inscription'], PDO::PARAM_INT);
        $state->bindValue('CONTENT',    $dataForm['textareaDecrypt'], PDO::PARAM_STR);
        $state->bindValue('IMAGEPATH', "IMG/lol.png", PDO::PARAM_STR);
        $state->bindValue('PDATE',      $postDate, PDO::PARAM_STR);
        $state->bindValue('PTYPE',      "ARTICLE", PDO::PARAM_STR);
        $state->bindValue('STATUS',     0, PDO::PARAM_INT);

        //Execute SQL request
        $state->execute();

        $temp = $sql->lastInsertId();

        $sql->commit();

        var_dump($temp);
        return $temp;
    }

}
?>