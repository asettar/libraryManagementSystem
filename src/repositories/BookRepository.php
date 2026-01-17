<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\models\Book;
use src\factories\BookFactory;
use PDO;

class BookRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findByISBN(string $ISBN) : ?Book {
        $row = $this->database->fetch("SELECT * FROM books where ISBN = :ISBN", ["ISBN" => $ISBN]);
        if (!$row) return NULL;
        return BookFactory::createFromArray($row);
    }
    
    public function findByTitle(string $title) : ?Book {
        $row = $this->database->fetch("SELECT * FROM books where title = :title", ["title" => $title]);
        if (!$row) return NULL;
        return BookFactory::createFromArray($row);
    }

    public function findByCategory(string $category) : array {
        $rows = $this->database->fetchAll("SELECT * FROM books where category = :category", ['category' => $category]);
        if (!$rows) return [];
        return array_map(fn($row) => BookFactory::createFromArray($row), $rows);
    }

}

?>