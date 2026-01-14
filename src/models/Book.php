<?php

namespace src\models;
use DateTime;

class Book
{
    private string      $isbn;
    private string      $title;
    private DateTime    $publicationYear;
    private string      $category;

    public function __construct(string $isbn, string $title, DateTime $publicationYear, string $category) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->category = $category;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPublicationYear(): DateTime {
        return $this->publicationYear;
    }

    public function getCategory(): string {
        return $this->category;
    }
}