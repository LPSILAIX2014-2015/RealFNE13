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
                $user = new MUser($result['ID']) ;
            }
            else {
                debugAlert('Erreur d\'authentification') ; // ToDo TEMP A MODIFIER
                $fail->addAttempt();

                if ($fail->getAttempts() >= LOGINFAIL_ATTEMPTS) {
                    debugAlert(LOGINFAIL_ATTEMPTS.' echecs de connexion, votre compte est bloqué pour les '.ceil($failremain/60).' prochaines minutes');
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