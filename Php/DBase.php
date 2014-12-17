<?php
class DBase extends PDO {

    private static $engine = 'mysql';
    private static $dbName = 'FNESITE' ; 
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';
    private static $cont  = null;

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
            $query = "SELECT * FROM user where MAIL = :email OR SURNAME = :surname";
            $qq = $pdo->prepare($query);
            $qq->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $qq->bindParam(':surname', $surname, PDO::PARAM_STR, 64);
            $qq->execute();
            $data = $qq->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        public static function getByID($id)
        {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM user where ID = :id";
            $qq = $pdo->prepare($query);
            $qq->bindParam(':id', $id, PDO::PARAM_INT);
            $qq->execute();
            $data = $qq->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        
        public static function getUserByEmail($email) {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM user WHERE MAIL = :email";
            $qq = $pdo->prepare($sql);
            $qq->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $qq->execute();
            $rows = $qq->fetch(PDO::FETCH_ASSOC);
            
            return $rows;
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
            $sql = "SELECT * FROM theme WHERE ID = :id ";
            $qq = $pdo->prepare($sql);
            $qq->bindParam(':id', $id, PDO::PARAM_INT);
            $qq->execute();
            $rows = $qq->fetch(PDO::FETCH_ASSOC);
            
            return $rows['NAME'];
        }
        
        public static function getAssociation($id) {
            $pdo = self::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM association WHERE ID = :id ";
            $qq = $pdo->prepare($sql);
            $qq->bindParam(':id', $id, PDO::PARAM_INT);
            $qq->execute();
            $rows = $qq->fetch(PDO::FETCH_ASSOC);
            
            return $rows['NAME'];
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
