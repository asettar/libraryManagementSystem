<?php 

namespace src\repositories;

use Exception;
use src\interfaces\ConnectionInterface;
use src\factories\BorrowRecordFactory;
use src\models\BorrowRecord;

use function PHPUnit\Framework\returnArgument;

class BorrowRepository {
    private ConnectionInterface $database;
    public function __construct(ConnectionInterface $database) {
        $this->database = $database;
    }

    public function find(string $bookIsbn, int $memberId) : BorrowRecord {
        $sql = "SELECT * FROM borrow_records
                WHERE book_isbn = :bookIsbn AND member_id = :memberId"; 
        $row = $this->database->fetch($sql, ['bookIsbn' => $bookIsbn, 'memberId' => $memberId]);
        if (!$row) throw new Exception("borrow record not found");
        return BorrowRecordFactory::createFromArray($row);
    }
    
    public function delete(string $bookIsbn, int $memberId) : bool {
        $sql = "DELETE FROM borrow_records
                 WHERE book_isbn = :bookIsbn AND member_id = :memberId"; 
        return $this->database->query($sql, ['bookIsbn' => $bookIsbn, 'memberId' => $memberId]);
    }

    public function insert(BorrowRecord $record): bool {
        $data = $record->getData();
        $sql = "INSERT INTO borrow_records (book_isbn, member_id, borrow_date, due_date)
                VALUES (:book_isbn, :member_id, :borrow_date, :due_date)";
        $result = $this->database->query($sql, $data);
        if (!$result) throw new Exception("row not inserted");
        return true;
    }

    public function memberHasOverdueBooks(int $memberId) : bool {
        $sql = "SELECT * from borrow_records
                 WHERE  member_id = $memberId AND due_date < NOW()
                 LIMIT 1";
        return $this->database->query($sql);
    }
}
?>