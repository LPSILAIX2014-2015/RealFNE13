<?php

class CloginFail {

    private $user ;
    private $ip;
    private $expire;
    private $attempts;

    function __construct($id)
    {
        $db = new MDBase();

        /*
         * Purge des entrées périmées
         */
        $query = 'DELETE FROM LOGINFAIL WHERE EXPIRE < NOW() ;' ;
        $state = $db->prepare($query);
        $state->execute();
        /**/
        $query = "SELECT * FROM LOGINFAIL WHERE ID_USER='$id'" ;
        $state = $db->prepare($query);
        $state->execute();
        $result = $state->fetch();
        /*
         * Si une entrée existe pour cet utilisateur on la récupère et on incrémente le nombre d'echecs de 1
         * Au bout de LOGINFAIL_WARNING echecs une notification est créée pour signaler la tentative de connexion
         * Au bout de LOGINFAIL_ATTEMPTS echecs le compte est bloqué pour LOGINFAIL_EXPIRE secondes et une notification est créée pour signaler le blocage du compte
         * le blocage du compte est géré par la connexion dans Class/CConnexion.class.php
         */
        if (testVar($result)) {
            $this->user = $result['ID_USER'];
            $this->ip = $result['IP'] ;
            $tmp = explode(' ',$result['EXPIRE']);
            $tmpD = explode('-',$tmp[0]);
            $tmpH = explode(':',$tmp[1]);
            $this->expire = mktime($tmpH[0],$tmpH[1],$tmpH[2],$tmpD[1],$tmpD[2],$tmpD[0]) ;
            $this->attempts = $result['ATTEMPTS'];
        }
        else {
            $this->attempts = 0 ;
            $this->user = $id;
            $this->expire = time() + LOGINFAIL_EXPIRE ;
            $this->ip = $_SERVER["REMOTE_ADDR"];
            $query = 'INSERT INTO LOGINFAIL (ID_USER,IP,EXPIRE,ATTEMPTS) VALUES ('.$this->user.',\''.$this->ip.'\',FROM_UNIXTIME('.$this->expire.'),'.$this->attempts.') ;' ;
            $state = $db->prepare($query);
            $state->execute();
        }
    }

    public function getAttempts()
    {
        return $this->attempts;
    }

    public function getExpire()
    {
        return $this->expire;
    }
    public function addAttempt() {
        if ($this->getAttempts() <= LOGINFAIL_ATTEMPTS) {
            $this->attempts ++ ;

            $db = new MDBase();
            $query = 'UPDATE LOGINFAIL SET ATTEMPTS='.($this->attempts).', EXPIRE=FROM_UNIXTIME('.(time() + LOGINFAIL_EXPIRE).') WHERE ID_USER='.($this>user).' ;' ;
            $state = $db->prepare($query);
            $state->execute();

            return true ;
        }
        return false ;
    }
}