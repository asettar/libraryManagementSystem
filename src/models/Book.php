<?php

namespace src\models;
use DateTime;

class Book
{
    private string      $isbn;
    private string      $title;
    private string    $publicationYear;
    private string      $category;
    private int         $branchId;
    private string      $status;       // available, checked_out, reserved, lost

    public function __construct(string $isbn, string $title, string $publicationYear, string $category, int $branchId, string $status) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->category = $category;
        $this->branchId = $branchId;
        $this->status = $status;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPublicationYear(): string {
        return $this->publicationYear;
    }

    public function getCategory(): string {
        return $this->category;
    }
    
    public function getBranchId(): int {
        return $this->branchId;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    } 

    public function isAvailable(): bool {
        return $this->status === 'available';
    }

     public function canBeBorrowed() : bool {
        return ($this->isAvailable());
    }

    public function canBeReserved() : bool {
        return ($this->status === 'checked_out');
    }   

    public function __toString() {
        return "ISBN: {$this->isbn}, Title: {$this->title}, Status: {$this->status}" . PHP_EOL;
    }
}
