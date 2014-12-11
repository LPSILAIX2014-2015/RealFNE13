<?php
    /* Fonction de connexion qui récupère login et mot de passe depuis le formulaire, appelé par le fichier connexion.js
    qui utilise l'ajax pour vérifier et recharger le contenu dynamiquement et non la page entière.
    Si la connexion est un succès, la page courante est rechargée. */

    function connexion($login =NULL, $password=NULL) {
        global $user;

        $login = (testVar($_POST['login'])) ? $_POST['login'] : $login;
        $password  = (testVar($_POST['password']))  ? $_POST['password']  : $password;

        try
        {
            $db = new DBase();

            $query = "SELECT * FROM USER WHERE LOGIN='$login' AND PASSWORD='$password'" ;
            $state = $db->prepare($query);
            $state->execute();
            $result = $state->fetch();

            if (testVar($result))
            {
                $_SESSION['ID_USER'] = $result['ID'];
                $user = new CUser($result['ID']) ;
            }
            else {
                debugAlert('Erreur d\'authentification') ; // ToDo TEMP A MODIFIER
            }
        }
        catch (Exception $ex)
        {
            $error_log = "[Error]"."[connexion.php]"."connection() : ".$ex->getMessage();
            echo $error_log;
            return false;
        }

    }
?>