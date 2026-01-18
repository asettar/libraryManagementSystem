<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\factories\BranchFactory;
use src\models\Branch;

class BranchRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findById(int $id) : Branch {
        $row = $this->database->fetch("SELECT * FROM branches WHERE id = :id", ["id" => $id]);
        if (!$row) throw new \Exception("branch with id : $id not found.");
        return BranchFactory::createFromArray($row);
    }
}
?>