<?php

class DBase extends PDO {

    private $engine = 'mysql';
    private $host = 'localhost';
    private $database = 'FNESITE';
    private $user = 'root';
    private $pass = 'mysql';

    public function __construct() {
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
}
?>