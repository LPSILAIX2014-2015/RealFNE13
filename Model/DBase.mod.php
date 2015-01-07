<?php
class DBase extends PDO {

<<<<<<< HEAD:Php/DBase.php
    private static $engine = 'mysql';
    private static $dbName = 'FNESITE' ; 
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont  = null;
=======
    private $engine = 'mysql';
    private $host = 'localhost';
    private $database = 'FNESITE';
    private $user = 'test';
    private $pass = 'test';
>>>>>>> 201f313004222dc82bd89c4d779aff593fc34130:Model/DBase.mod.php

    public function __construct(){
        $dns = self::$engine.':dbname='.self::$dbName.";host=".self::$dbHost;
        parent::__construct( $dns, self::$dbUsername, self::$dbUserPassword );
    }
    
    public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
        
        public static function getUser($email, $surname)
        {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM user where MAIL = ? OR SURNAME = ?";
            $qq = $pdo->prepare($query);
            $qq->execute(array($email, $surname));
            $data = $qq->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public static function getByID($id)
        {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM user where ID = ?";
            $qq = $pdo->prepare($query);
            $qq->execute(array($id));
            $data = $qq->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        
        public static function getUserByEmail($email) {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM user WHERE MAIL LIKE '". $email . "'";
            $data = null;
            foreach ($pdo->query($sql) as $row) {
                $data = $row;
            }
            return $data;
        }

        public static function getAllUsers()
        {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'SELECT * FROM user ORDER BY NAME ASC';
            $data = $pdo->query($sql);
            return $data;
        }
        
        public static function getTheme($id) {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM theme WHERE ID = '". $id . "'";
            $data = null;
            foreach ($pdo->query($sql) as $row) {
                $data = $row['NAME'];
            }
            return $data;
        }
        
        public static function getAssociation($id) {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM association WHERE ID = '". $id . "'";
            $data = null;
            foreach ($pdo->query($sql) as $row) {
                $data = $row['NAME'];
            }
            return $data;
        }
        
        public static function getAllThemes() {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM theme";
            $data = array();
            foreach ($pdo->query($sql) as $row) {
                $data[] = $row;
            }
            return $data;
        }
}
?>
