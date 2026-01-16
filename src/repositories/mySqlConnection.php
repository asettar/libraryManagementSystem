<?php 

namespace src\repositories;
use src\interfaces\databaseInterface;
use PDO;

class mySqlConnection implements databaseInterface {
    private PDO $connection;

    private string $host = "localhost";
    private string $dbname = "librarySystem";
    private string $username = "root";
    private string $password = "AchrafSettar123*/";

    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    public  function    getConnection() : PDO {
        return $this->connection;
    }
}

?>