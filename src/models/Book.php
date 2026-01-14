<?php

namespace App\Entities;

use DateTime;

class Book
{
    private int $id;
    private string $title;
    private string  $isbn;
    private DateTime $publicationYear;
    private string  $status; // "available", "checked_out", "reserved", "lost"

    public function __construct(string $isbn, string $title, DateTime $publicationYear, string $status) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->status = $status;
    }

    public function getIsbn(): string {
        return $this->status;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function isAvailable(): bool {
        return $this->status === 'available';
        }
        
    public function isReseverd() : bool {
        return $this->status === 'reserved';
    }
}