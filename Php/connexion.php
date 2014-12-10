<?php
    // ToDo inclure connexion.php dans le projet courant pour abiliter l'accès $connec à la base

    /* Fonction de connexion qui récupère login et mot de passe depuis le formulaire, appelé par le fichier connexion.js
    qui utilise l'ajax pour vérifier et recharger le contenu dynamiquement et non la page entière.
    Si la connexion est un succès, la page courante est rechargée. */


    function connexion($login =NULL, $password=NULL) {
        global $db;

        $login = (testVar($_REQUEST['login'])) ? $_REQUEST['login'] : $login;
        $password  = (testVar($_REQUEST['password']))  ? $_REQUEST['password']  : $password;
        try
        {
            $state = $db->prepare("SELECT * FROM USER WHERE LOGIN=$login AND PASSWORD=$password");
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            if (testVar($result) && testVar($_SESSION))
            {
                $_SESSION['user'] = new CUser($result['ID']);
                debugAlert($_SESSION['user']);
            }
            else {
                debugAlert('Erreur d\'authentification') ;
            }
        }
        catch (Exception $ex)
        {
            $error_log = "[Error]"."[connexion.php]"."connection() : ".$ex->getMessage();
            echo $error_log;
            return false;
            debugAlert($error_log);
        }

    }
?>