<?php

namespace src\models;
use DateTime;

class Book
{
    private string      $isbn;
    private string      $title;
    private string      $publicationYear;
    private string      $category;
    private int         $branchId;
    private string      $status;       // available, checked_out, reserved, lost
    private int         $isRenewed;

    public function __construct(string $isbn, string $title, string $publicationYear, string $category,
        int $branchId, string $status, int $isRenewed) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->publicationYear = $publicationYear;
        $this->category = $category;
        $this->branchId = $branchId;
        $this->status = $status;
        $this->isRenewed = $isRenewed;
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

    public function isRenewd() : bool {
        return $this->isRenewed;
    }

    public function isAvailable(): bool {
        return $this->status === 'available';
    }

    public function isReserved(): bool {
        return $this->status === 'reserved';
    }

    public function setStatus($status) : void {
        $this->status = $status;
    } 
        
    public function renew() : void {
        $this->isRenewed = true;
    }

    public function unrenew() : void {
        $this->isRenewed = false;
    }

    public function canBeBorrowed() : bool {
        return ($this->isAvailable());
    }

    public function canBeReserved() : bool {
        return ($this->status === 'checked_out');
    }   

    public function __toString() {
        return "ISBN: {$this->isbn}, Title: {$this->title}, Status: {$this->status}, branch_id : {$this->branchId}
                      Category: {$this->category}, isRenewed : {$this->isRenewed}". PHP_EOL;
    }

    public function getChangeableData(): array {
        return [
            'status' => $this->status,
            'is_renewed' => $this->isRenewed ? 1 : 0
        ];
    }

}
