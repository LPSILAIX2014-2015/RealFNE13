<?php
    // ToDo inclure connexion.php dans le projet courant pour abiliter l'accès $connec à la base

    /* Fonction de connexion qui récupère login et mot de passe depuis le formulaire, appelé par le fichier connexion.js
    qui utilise l'ajax pour vérifier et recharger le contenu dynamiquement et non la page entière.
    Si la connexion est un succès, la page courante est rechargée. */


    function connexion($login =NULL, $password=NULL) {
        global $db, $user;

        $login = (testVar($_POST['login'])) ? $_POST['login'] : $login;
        $password  = (testVar($_POST['password']))  ? $_POST['password']  : $password;
        debugAlert('Dans connexion : $login = '.$login);
        try
        {
            $db = new DBase();
            $state = $db->prepare("SELECT * FROM USER WHERE LOGIN=$login AND PASSWORD=$password");
            $state->execute();

            $result = $state->fetch(PDO::FETCH_ASSOC);

            debugAlert($db) ;
            if (testVar($result) )
            {
                $_SESSION['ID_USER'] = $result['ID'];
                $user = new CUser($result['ID']) ;
                debugAlert($_SESSION['ID_USER']);
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