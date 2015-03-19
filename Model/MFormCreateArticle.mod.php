<?php
    //petite fonction pour filtrer le nom des fichier (remplace les accent et les apostrophes etc...), elle devrait pas se trouver là mais on va faire comme si on avait rien vu :3
    function replace_accents($string){ 
            return str_replace( array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý', '\''), array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y', '_'), $string);
    }

    class MFormCreateArticle
    {
        function __construct ($id = null) {
            //connection à la base
            $sql = new MDBase();
            $state = $sql->prepare("SELECT * FROM POST WHERE ID = :id;"); // requete à effectuer
            $state->bindValue('id', $id, PDO::PARAM_INT); //le :id de la requete n'a aucune valeur, on lui bind alors celle de
            $state->execute();                            //$id (parametre du contructeur). On éxécute ensuite la requête
            $report = $state->fetch(PDO::FETCH_ASSOC);    //On récupère le résultat sous forme de tableau dans la variable $report
            /*
                PDO::FETCH_ASSOC permet de récuperer les résultats sous forme de tableau, on accede donc aux élément avec des []
                PDO::FETCH_OBJECT permet de récuperer les résultats sous forme d'objets, on accede donc aux élément avec des ->
            */
        }
        public function __destruct(){}

        public function insertDB($data, $pathImage){

            $temp = 0;

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

            /**
            
            Connexion sql

            **/

            $sql = new MDBase();

            /**
            Requete et Bind des values
            **/

            $sql->beginTransaction();
            $state = $sql->prepare("INSERT INTO POST (
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
            }

            //Bind datavalue and databases fields. 
            $state->bindValue('WRITER_ID',  $_SESSION['ID_USER'],         PDO::PARAM_INT);
            $state->bindValue('TITLE',      $dataForm['articleTitle'],    PDO::PARAM_STR);
            $state->bindValue('THEME_ID',   $dataForm['articleTheme'],    PDO::PARAM_INT);
            $state->bindValue('PLACE',      $dataForm['eventPlace'],      PDO::PARAM_STR);
            $state->bindValue('DATE_BEGIN', $dataForm['startDate'],       PDO::PARAM_STR);
            $state->bindValue('DURATION',   $dataForm['duration'],        PDO::PARAM_INT);
            $state->bindValue('INSCRIPTION',$dataForm['inscription'],     PDO::PARAM_INT);
            $state->bindValue('CONTENT',    $dataForm['textareaDecrypt'], PDO::PARAM_STR);
            $state->bindValue('IMAGEPATH',  $pathImage,                   PDO::PARAM_STR);
            $state->bindValue('PDATE',      date('Y-m-d'),                PDO::PARAM_STR);
            $state->bindValue('PTYPE',      "ARTICLE",                    PDO::PARAM_STR);
            $state->bindValue('STATUS',     0,                            PDO::PARAM_INT);

            /**
            Execute SQL request
            **/

            $state->execute();

            //$temp return the ID of the last row inserted
            $temp = $sql->lastInsertId();

            $sql->commit();
        
            return $temp; 
        }
    }
?>