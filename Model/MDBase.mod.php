<?php
class MDBase extends PDO {


    private static $engine = 'mysql';

    //Site LOCAL
    private static $dbName = 'FNESITE' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont  = null;

    //Site DEV
/*
    private static $dbName = 'fnekxazadev' ;
    private static $dbHost = 'mysql51-84.pro' ;
    private static $dbUsername = 'fnekxazadev';
    private static $dbUserPassword = 'natureC13';
    private static $cont  = null;
*/

    //LOCAL
/*
    private static $dbName = 'FNESITE' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = 'mysql';
    private static $cont  = null;
*/

    public function __construct(){
        $dns = self::$engine.':dbname='.self::$dbName.";host=".self::$dbHost;
        parent::__construct( $dns, self::$dbUsername, self::$dbUserPassword );
        $this->exec("SET CHARACTER SET utf8");
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

    public static function getAllUsers()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM USER";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllAssocs()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM ASSOCIATION";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchall();
        return $data;
    }

    public static function getAllMessages()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM MESSAGE";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllNewsL()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM NEWSLETTER";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllPosts()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM POST";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllReports()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM REPORT";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllTerritories()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM TERRITORY";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchall();
        return $data;
    }

    public static function getAllThemes()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM THEME";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public static function getAllCategories()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM MESCAT";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function getUserByEmail($mail){
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM USER WHERE MAIL = ?";
        $qq = $pdo->prepare($query);
        $qq->execute(array($mail));
        $data = $qq->fetchall();
        return $data;
    }
}
?>
