<?php
class CConnexion {
    public function connexion($login =NULL, $password=NULL) {
        global $user;

        $login = (testVar($_POST['login'])) ? $_POST['login'] : $login;
        $password  = (testVar($_POST['password']))  ? $_POST['password']  : $password;

        try
        {
            $db = new MDBase();

            $query = "SELECT * FROM USER WHERE LOGIN='$login' AND PASSWORD='$password'" ;
            $state = $db->prepare($query);
            $state->execute();
            $result = $state->fetch();

            if (testVar($result))
            {
                $_SESSION['ID_USER'] = $result['ID'];
                $_SESSION['ROLE'] = $result['ROLE'];
                $user = new MUser($result['ID']) ;
            }
            else {
                debugAlert('Erreur d\'authentification') ; // ToDo TEMP A MODIFIER
            }
        }
        catch (Exception $ex)
        {
            $error_log = "[Error]"."[CConnexion.class.php]"."connection() : ".$ex->getMessage();
            echo $error_log;
            return false;
        }

    }
}
?>