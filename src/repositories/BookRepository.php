<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\models\Book;
use PDO;

class BookRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findByISBN(string $ISBN) : ?Book {
        $row = $this->database->fetch("SELECT * FROM books where ISBN = :ISBN", ["ISBN" => $ISBN]);
        if (!$row) return NULL;
        return new Book($row['isbn'], $row['title'], $row['publication_year'], 
        $row['category'], $row['branch_id'], $row['status']);
    }

    public function findByCategory(string $category) : array {
        $rows = $this->database->fetchAll("SELECT * FROM books where category = :category", ['category' => $category]);

        $books = [];
        foreach ($rows as $row) {
            $books[] = new Book($row['isbn'], $row['title'], $row['publication_year'], 
            $row['category'], $row['branch_id'], $row['status']);
        }
        return $books;
    }
}

?>