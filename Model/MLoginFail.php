<?php

class MLoginFail {

    private $sql;

    private $id_user;
    private $ip;
    private $expire;
    private $attempts;

    function __construct ($id) {
        $this->sql = new MDBase();
        $state = $this->sql->prepare("SELECT * FROM ASSOCIATION WHERE ID = :id");
        $state->bindValue('id', $id, PDO::PARAM_INT);
        $state->execute();
        $assoc = $state->fetch(PDO::FETCH_ASSOC);

        $this->id = $id;
        $this->name = $assoc['NAME'];
        $this->territory= $assoc['TERRITORY_ID'];
        $this->theme= $assoc['THEME_ID'];
    }


    // Getters
    public function getIdUser() { return $this->id_user; }
    public function getIp() { return $this->ip; }
    public function getExpire() { return $this->expire; }
    public function getAttempts() { return $this->attempts; }


    // Setters
    public function setIp($ip)
    {
        $this->ip = $ip;
        $this->sql->exec('UPDATE LOGINFAIL SET IP = \''.$ip.'\' WHERE ID = '.$this->id.' ;');

    }

    public function setExpire($expire)
    {
        $this->expire = $expire;
        $this->sql->exec('UPDATE LOGINFAIL SET TERRITORY_ID = \''.$expire.'\' WHERE ID = '.$this->id.' ;');
    }


    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;
        $this->sql->exec('UPDATE LOGINFAIL SET THEME_ID = \''.$attempts.'\' WHERE ID = '.$this->id.' ;');
    }

}