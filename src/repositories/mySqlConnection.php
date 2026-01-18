<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use PDO;
use PDOStatement;

class MySqlConnection implements ConnectionInterface {
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

    public function query(string $sql, array $data = []) : bool {
        return (bool)$this->executeStatement($sql, $data);
    }
}

?>