<?php 

namespace src\repositories;
use src\interfaces\DatabaseInterface;
use src\models\Book;
use PDO;

class BookRepository {
    private PDO $connection;
    public function __construct(DatabaseInterface $database) {
        $this->connection = $database->getConnection();
    }

    public function findByISBN(string $ISBN) : ?Book {
        $stmt = $this->connection->prepare("SELECT * FROM books where ISBN = :ISBN");
        $stmt->execute(['ISBN' => $ISBN]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            echo "yes\n";
            return NULL;
        }
        return new book($row['isbn'], $row['title'], $row['publication_year'], 
        $row['category'], $row['branch_id'], $row['status']);
    }
}
?>