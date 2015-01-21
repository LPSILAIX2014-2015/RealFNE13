<?php
class CConnexion {
    public function connexion($login =NULL, $password=NULL) {
        global $user;

        $login = (testVar($_POST['login'])) ? $_POST['login'] : $login;
        $password  = (testVar($_POST['password']))  ? $_POST['password']  : $password;

        try
        {
            $db = new MDBase();

            $query = "SELECT ID, PASSWORD FROM USER WHERE LOGIN='$login'" ;
            $state = $db->prepare($query);
            $state->execute();
            $result = $state->fetch();

            $fail = new CloginFail($result['ID']) ;
            $failremain = $fail->getExpire() - time() ;

            if (($result['PASSWORD'] === $password) && (($fail->getAttempts() < LOGINFAIL_ATTEMPTS) || ($failremain <= 0)))
            {
                $_SESSION['ID_USER'] = $result['ID'];
                $_SESSION['ROLE'] = $result['ROLE'];
                $user = new MUser($result['ID']) ;

                $query = 'DELETE FROM LOGINFAIL WHERE ID_USER='.$result['ID'].' AND IP=\''.$_SERVER["REMOTE_ADDR"].'\' ;' ;
                $state = $db->prepare($query);
                $state->execute();
            }
            else {
                debugAlert('Erreur d\'authentification') ; // ToDo TEMP A MODIFIER
                $fail->addAttempt();

                if ($fail->getAttempts() == LOGINFAIL_WARNING) {
                    $user = new MUser($result['ID']) ;
                    $msg = $user->getSurname().' '.$user->getName().' a échoué '.LOGINFAIL_WARNING.' fois à se connecter (IP : '.$_SERVER["REMOTE_ADDR"].').' ;
                    $query = 'INSERT INTO REPORT VALUES (NULL, CURDATE(), "ALERTE", "'.$msg.'");' ;
                    $state = $db->prepare($query);
                    $state->execute();
                    unset($_SESSION);
                    unset($GLOBALS['user']);
                }
                if ($fail->getAttempts() == LOGINFAIL_ATTEMPTS) {
                    $user = new MUser($result['ID']) ;
                    $msg = $user->getSurname().' '.$user->getName().' a échoué '.LOGINFAIL_ATTEMPTS.' fois à se connecter, son compte a été bloqué (IP : '.$_SERVER["REMOTE_ADDR"].').' ;
                    $query = 'INSERT INTO REPORT VALUES (NULL, CURDATE(), "ALERTE", "'.$msg.'");' ;
                    $state = $db->prepare($query);
                    $state->execute();
                    unset($_SESSION);
                    unset($GLOBALS['user']);
                }

                if ($fail->getAttempts() >= LOGINFAIL_ATTEMPTS) {
                    debugAlert(LOGINFAIL_ATTEMPTS.' echecs de connexion, votre compte est bloqué pour les '.ceil($failremain/60).' prochaines minutes');
                    unset($_SESSION);
                    unset($GLOBALS['user']);
                }
            }
        }
        catch (Exception $ex)
        {
            $error_log = "[Error]"."[CConnexion.class.php]"."connection() : ".$ex->getMessage();
            if (modeDebug) { echo $error_log; }
            return false;
        }

    }
}
?>