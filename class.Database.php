<?php
class Database
{
    private $host = "localhost";
    private $db_name = "janesik2";
    private $username = "janesik2";
    private $password = "uohhg";
    public static $instance;
    private $conn = null ;



    protected function __construct()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    protected function __clone() {}
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
    private function __sleep()
    {
        throw new Exception("Cannot serialize singleton");
    }

    public static function getInstance()
    {
        if( !(self::$instance instanceof self) ){
            self::$instance = new self();
        }
        return self::$instance;
    }


}
?>