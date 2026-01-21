<?php 

namespace src\repositories;

use Dom\Mysql;
use src\interfaces\ConnectionInterface;
use PDO;
use PDOStatement;

class MySqlConnection implements ConnectionInterface {
    private static ?MySqlConnection  $instance = null;
    private ?PDO $connection;

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

    public static function getInstance() : MySqlConnection {
        if (!self::$instance) self::$instance = new MySqlConnection();
        return self::$instance;
    }

    private function executeStatement(string $sql, array $data) : ?PDOStatement {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($data);
        if (!$result) return NULL;
        return $stmt;
    }

    public function fetchAll(string $sql, array $data = []) : ?array {
        $stmt = $this->executeStatement($sql, $data);
        if (!$stmt) return NULL;
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(string $sql, array $data = []) : ?array {
        $stmt = $this->executeStatement($sql, $data);
        if (!$stmt) return NULL;
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: NULL;
    }

    public function query(string $sql,   $data = []) : bool {
        $stmt = $this->executeStatement($sql, $data);
        
        return ($stmt && $stmt->rowCount() > 0);
    }

    public function beginTransaction() : bool {
        return $this->connection->beginTransaction();
    }

    public function rollBack() : bool {
        return $this->connection->rollBack();
    }
}

?>