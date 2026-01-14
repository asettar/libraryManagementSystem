<?php

namespace src\models;

use DateTime;

class BookCopy
{
    private int $id;
    private Book $book;           // the main Book the copy belongs to
    private Branch $branch;       // which branch holds this copy
    private string $status;       // available, checked_out, reserved, lost


    public function __construct(int $id, Book $book, Branch $branch, string $status, ?DateTime $dueDate = null
    ) {
        $this->id = $id;
        $this->book = $book;
        $this->branch = $branch;
        $this->status = $status;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getBook(): Book {
        return $this->book;
    }

    public function getBranch(): Branch {
        return $this->branch;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function isAvailable(): bool {
        return $this->status === 'available';
    }

    public function setStatus($status) {
        $this->status = $status;
    } 

    public function canBorrow() : bool {
        return ($this->isAvailable());
    }

    public function canbeReserved() : bool {
        return ($this->status === 'checked_out');
    }
}
