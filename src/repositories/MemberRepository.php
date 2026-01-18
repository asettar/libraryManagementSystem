<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\models\Book;
use src\factories\MemberFactory;
use PDO;
use src\models\Member;

class MemberRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findById(int $id) : ?Member {
        $row = $this->database->fetch("SELECT * FROM members WHERE id = :id", ["id" => $id]);
        if (!$row) return NULL;
        return MemberFactory::createFromArray($row);
    }}
?>