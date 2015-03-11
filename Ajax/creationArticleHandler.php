<?php

    session_start();
    require '../Model/MDBase.mod.php';
    require '../Model/MFormCreateArticle.mod.php';
    $formCreateArticle = new MFormCreateArticle();


    // check if the file uploaded corrupt the data
    if(count($_POST) < 1){
        $errorType = "Err_NotAnImage";
        $jsonarray = array("lastID" => 0, "errorType" => $errorType);
        $jsonReturned = json_encode($jsonarray);
        echo $jsonReturned;
        return false;
    }


    /**
    
    Controle Image

    **/

    /**
    récupération des infos
    **/


    //On check s'il y à une image, s'il y en à une, on la traite
    if(isset($_FILES["articleImage"]["name"]) AND strlen($_FILES["articleImage"]["name"]) > 3){

        $repertoireDestination = "../Img/ImgArticle/";
        $nomOrigine = $_FILES["articleImage"]["name"];
        
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg","png", "JPEG", "JPG", "PNG");
        $sanitizeFileName = replace_accents($_FILES["articleImage"]["name"]);

        $pathImage = $repertoireDestination . $sanitizeFileName;

        /**
        vérifications des champs
        **/

        //Check if the file is an image
        if (in_array($extensionFichier, $extensionsAutorisees)) {

            //Check if the size of the image is correct
            if($_FILES["articleImage"]["size"] <  $_POST["max_file_size"]){

                //Check if the file is correctly moved
                if (move_uploaded_file($_FILES["articleImage"]["tmp_name"], $pathImage)) {

                }else{
                    $errorType = "Err_UploadFail";
                    $jsonarray = array("lastID" => 0, "errorType" => $errorType);
                    $jsonReturned = json_encode($jsonarray);
                    echo $jsonReturned;
                    return false;
                }

            }else{
                $errorType = "Err_FileTooFat";
                $jsonarray = array("lastID" => 0, "errorType" => $errorType);
                $jsonReturned = json_encode($jsonarray);
                echo $jsonReturned;
                return false;
            }

        } else{
            $errorType = "Err_NotAnImage";
            $jsonarray = array("lastID" => 0, "errorType" => $errorType);
            $jsonReturned = json_encode($jsonarray);
            echo $jsonReturned;
            return false;
        }
    }

    /**
    Contrôle des champs
    **/

    // mettre des valeur par défaut pour duration et inscription quand ils ne sont pas renseignés.
    if(!isset($_POST['duration'])) $_POST['duration'] = 0;
    if(!isset($_POST['inscription'])) $_POST['inscription'] = 0;

    // arreter la fonction si l'ID de l'user, le titre ou le theme de l'article n'est pas renseigné.
    if($_SESSION['ID_USER'] == null){
        $errorType = "Err_UserNotLogged";
        $jsonarray = array("lastID" => 0, "errorType" => $errorType);
        $jsonReturned = json_encode($jsonarray);
        echo $jsonReturned;
        return false;
    }

    if(strlen($_POST['articleTitle']) == 0){
        $errorType = "Err_NoTittle";
        $jsonarray = array("lastID" => 0, "errorType" => $errorType);
        $jsonReturned = json_encode($jsonarray);
        echo $jsonReturned;
        return false;
    } 

    if(strlen($_POST['textareaDecrypt']) <= 50){
        $errorType = "Err_NoText";
        $jsonarray = array("lastID" => 0, "errorType" => $errorType);
        $jsonReturned = json_encode($jsonarray);
        echo $jsonReturned;
        return false;
    }

    if(isset($pathImage))
        $pathImage = substr($pathImage, 3);
    else
        $pathImage = null;

    /**
    
    traitement du formulaire

    **/

    $nextId = $formCreateArticle->insertDB($_POST, $pathImage);

    // s'il n'y a pas d'erreur, on informe que tout est OK, sinon on renvoi une erreur
    if (!isset($errorType) AND $nextId != '' AND $nextId != null)
        $errorType = "EverythingOK";
    else
        $nextId = 0;

    $jsonarray = array("lastID" => $nextId, "errorType" => $errorType);
    $jsonReturned = json_encode($jsonarray);
    echo $jsonReturned;
    return false;

?>