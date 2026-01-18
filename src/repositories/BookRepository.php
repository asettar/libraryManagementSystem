<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\models\Book;
use src\factories\BookFactory;
use PDO;
use src\models\Author;

class BookRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function findByISBN(string $ISBN) : ?Book {
        $row = $this->database->fetch("SELECT * FROM books WHERE ISBN = :ISBN", ["ISBN" => $ISBN]);
        if (!$row) return NULL;
        return BookFactory::createFromArray($row);
    }
    
    public function findByTitle(string $title) : array {
        $rows = $this->database->fetchAll("SELECT * FROM books WHERE title = :title", ["title" => $title] );
        if (!$rows) return [];
        return array_map(fn($row) => BookFactory::createFromArray($row), $rows);
    }

    public function findByCategory(string $category) : array {
        $rows = $this->database->fetchAll("SELECT * FROM books WHERE category = :category", ['category' => $category]);
        if (!$rows) return [];
        return array_map(fn($row) => BookFactory::createFromArray($row), $rows);
    }
    
    public function findByAuthor(int $authorId) : array {
		$rows = $this->database->fetchAll(
			"SELECT b.* from books b
			 JOIN book_author ba
			 ON ba.book_isbn = b.isbn
			 WHERE ba.author_id = :author_id"
		, ["author_id" => $authorId]);
        if (!$rows) return [];
		return array_map(fn($row) => BookFactory::createFromArray($row), $rows);
    }

	public function update(Book $book) {
		$data = $book->getChangeableData();
		$feilds = [];
		foreach($data as $key => $value) {
			if (is_string($value)) $value = "'$value'";
			$feilds[] = $key . "=" . $value;
		}
		$sql = "UPDATE books SET " . implode(', ', $feilds) . " WHERE isbn = '{$book->getIsbn()}'";
		$this->database->query($sql);  
	}
}

?>