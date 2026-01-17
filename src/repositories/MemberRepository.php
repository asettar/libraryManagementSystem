<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\models\Book;
use src\factories\MemberFactory;
use PDO;
use src\models\Member;

class BookRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }
}

?>