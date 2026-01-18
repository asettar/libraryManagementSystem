<?php 

namespace src\repositories;
use src\interfaces\ConnectionInterface;
use src\factories\BorrowRecordFactory;
use src\models\BorrowRecord;

class BorrowRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function find(string $bookIsbn, int $memberId) : ?BorrowRecord {
        $sql = "SELECT * FROM borrow_records
                WHERE book_isbn = :bookIsbn AND member_id = :memberId"; 
        $row = $this->database->fetch($sql, ['bookIsbn' => $bookIsbn, 'memberId' => $memberId]);
        if (!$row) return NULL;
        return BorrowRecordFactory::createFromArray($row);
    }
}
?>