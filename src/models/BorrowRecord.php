<?php 
namespace src\models;
use DateTime;

class BorrowRecord {
    private string $bookIsbn;
    private int $memberId;
    private DateTime $borrowDate;
    private DateTime $dueDate;

    public function __construct(string $bookIsbn, int $memberId, DateTime $borrowDate, DateTime $dueDate) {
        $this->bookIsbn = $bookIsbn;
        $this->memberId = $memberId;
        $this->borrowDate = $borrowDate;
        $this->dueDate = $dueDate;
    }

    public function getBookIsbn(): string {
        return $this->bookIsbn;
    }

    public function getMemberId(): int {
        return $this->memberId;
    }

    public function getBorrowDate(): DateTime {
        return $this->borrowDate;
    }

    public function getDueDate(): DateTime {
        return $this->dueDate;
    }

    public function isOverdue(): bool {
        $currentDate = new DateTime();
        return $currentDate > $this->dueDate;
    }

    public function setBorrowDate(DateTime $date) : void {
        $this->borrowDate = $date;
    }

    public function setDueDate(DateTime $date) : void {
        $this->dueDate = $date;
    }

    public function __toString(): string {
        return "Book ISBN: {$this->bookIsbn}, Member ID: {$this->memberId}, "
             . "Borrowed On: {$this->borrowDate->format('Y-m-d')}, "
             . "Due On: {$this->dueDate->format('Y-m-d')}";
    }

    public function getData() : array {
        return [
            'book_isbn' => $this->bookIsbn,
            'member_id' => $this->memberId,
            'borrow_date' => $this->borrowDate->format('Y-m-d H:i:s'),
            'due_date' => $this->dueDate->format('Y-m-d H:i:s'),
        ];
    }
}
?>
