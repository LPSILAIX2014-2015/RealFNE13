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

        /**
        
        Controle Image

        **/


        $repertoireDestination = "Img/ImgArticle/";

        $extensionsAutorisees = array("jpeg", "jpg","png");
        $nomOrigine = $_FILES["articleImage"]["name"];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];

        $maxImageSize = $_POST["max_file_size"];

        $pathImage = $repertoireDestination.$_FILES["articleImage"]["name"];

        var_dump($_FILES["articleImage"]);
        var_dump($elementsChemin);

        //Check if the file is an image
        if (in_array($extensionFichier, $extensionsAutorisees)) {
            echo "Ce fichier à la bon format";

            //Check if the size of the image is correct
            if($_FILES["articleImage"]["size"] < $maxImageSize){
                echo "Ce fichier à la bonne taille";

                //Check if the file is correctly moved
                if (move_uploaded_file($_FILES["articleImage"]["tmp_name"],$repertoireDestination.$_FILES["articleImage"]["name"])) {
                    echo "Ce fichier à bien été placé";

                }else{
                    echo "L'upload du fichier à échoué";
                    return;
                }

            }else{
                echo "L'image est trop volumineuse";
                return;
            }

        } else{
            echo "Ce type de fichier n'est pas autorisé";
            return;
        }

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
            "textareaDecrypt"   => FILTER_SANITIZE_SPECIAL_CHARS,
            "articleImage"      => FILTER_SANITIZE_SPECIAL_CHARS
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
        if(!$state) {
            $sql->rollBack();
            return false;
        }


        //Bind datavalue and databases fields. 
        $state->bindValue('WRITER_ID',  $_SESSION['ID_USER'], PDO::PARAM_INT);
        $state->bindValue('TITLE',      $dataForm['articleTitle'], PDO::PARAM_STR);
        $state->bindValue('THEME_ID',   $dataForm['articleTheme'], PDO::PARAM_INT);
        $state->bindValue('PLACE',      $dataForm['eventPlace'], PDO::PARAM_STR);
        $state->bindValue('DATE_BEGIN', $dataForm['startDate'], PDO::PARAM_STR);
        $state->bindValue('DURATION',   $dataForm['duration'], PDO::PARAM_INT);
        $state->bindValue('INSCRIPTION',$dataForm['inscription'], PDO::PARAM_INT);
        $state->bindValue('CONTENT',    $dataForm['textareaDecrypt'], PDO::PARAM_STR);
        $state->bindValue('IMAGEPATH',  $pathImage, PDO::PARAM_STR);
        $state->bindValue('PDATE',      date('Y-m-d'), PDO::PARAM_STR);
        $state->bindValue('PTYPE',      "ARTICLE", PDO::PARAM_STR);
        $state->bindValue('STATUS',     0, PDO::PARAM_INT);

        //Execute SQL request
        $state->execute();

        $temp = $sql->lastInsertId();

        //$temp return the ID of the last row inserted
        $sql->commit();

        var_dump($temp);
        return $temp;
    }

}
?>