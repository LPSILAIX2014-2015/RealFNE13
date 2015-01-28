<?php
class MDBase extends PDO {

    private $engine = 'mysql';
    private $host = 'localhost';
    private $database = 'FNESITE';
    private $user = 'root';
    private $pass = '';
    private $cont = '';

    public function __construct() {
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        parent::__construct( $dns, $this->user, $this->pass );
    }
    
    public function connect()
	{
	   // One connection through whole application
       if ( null == $this->cont )
       {
        try
        {
          $this->cont =  new PDO( "mysql:host=".$this->host.";"."dbname=".$this->database, $this->user, $this->pass);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return $this->cont;
	}

    public static function getAllUsers()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM user";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getAllAssocs()
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

    public function getAllTerritories()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM TERRITORY";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchall();
        return $data;
    }

    public function getAllThemes()
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM THEME";
        $qq = $pdo->prepare($query);
        $qq->execute();
        $data = $qq->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getUserByEmail($mail)
    {
        $pdo = self::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM User WHERE Mail = ?";
        $qq = $pdo->prepare($query);
        $qq->execute(array($mail));
        $data = $qq->fetchall();
        return $data;
    }
}
?>
