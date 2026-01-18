<?php

namespace src\factories;

use src\models\BorrowRecord;
use DateTime;

class BorrowRecordFactory {
    public static function createFromArray(array $data): BorrowRecord
    {
        return new BorrowRecord(
            $data['book_isbn'],
            $data['member_id'],
            new DateTime($data['borrow_date']),
            new DateTime($data['due_date'])
        );
    }
}

?>
