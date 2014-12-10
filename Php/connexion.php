<?php
    // ToDo inclure connexion.php dans le projet courant pour abiliter l'accès $connec à la base

    /* Fonction de connexion qui récupère login et mot de passe depuis le formulaire, appelé par le fichier connexion.js
    qui utilise l'ajax pour vérifier et recharger le contenu dynamiquement et non la page entière.
    Si la connexion est un succès, la page courante est rechargée. */

    function connexion($login =NULL, $password=NULL) {
        $login = (testVar($_REQUEST['login'])) ? $_REQUEST['login'] : $login;
        $password  = (testVar($_REQUEST['password']))  ? $_REQUEST['password']  : $password;
        $conn = new DBase();
        try
        {
            if (testVar($login))
            {
                echo '';
            }
            if (testVar($password))
            {
                echo '';
            }

            $state = $conn->prepare("SELECT * FROM USER WHERE LOGIN=$login AND PASSWORD=$password");
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            if (testVar($connec))
            {
                $_SESSION['ROLE'] = $result['ROLE'];
                $_SESSION['ID_USER'] = $result['ID'];
            }
        }
        catch (Exception $ex)
        {
            $error_log = "[Error]"."[connexion.php]"."connection() : ".$ex->getMessage();
            echo $error_log;
            return false;
        }

    }

    //FONCTION SIMPLE DE VERIFICATION DE L'EXISTENCE D'UNE VARIABLE ET DE SON CONTENU (not null)

    function testVar (&$val)
    {
        if (!empty($val) && isset($val))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
?>