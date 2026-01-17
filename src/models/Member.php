<?php

namespace src\models;

use DateTime;

abstract class Member
{
    protected int       $id;
    protected string    $name;
    protected string    $email;
    protected string    $phoneNumber;
    protected ?DateTime $membershipEndDate = null;
    protected int       $currentBorrowedCount; 
    protected int       $loanPeriod;
    protected float     $lateFee;
    protected int       $borrowLimit;

    public function __construct(int $id, string $name, string $email, string $phoneNumber, ?DateTime $membershipEndDate, int $currentBorrowedCount) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->membershipEndDate = $membershipEndDate;
        $this->currentBorrowedCount = $currentBorrowedCount;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getMembershipEndDate(): ?DateTime {
        return $this->membershipEndDate;
    }

    public function getLoanPeriod(): int {
        return $this->loanPeriod;
    }

    public function getBorrowLimit(): int {
        return $this->borrowLimit;
    }

    public function getLateFee(): int {
        return $this->lateFee;
    }

    public function hasActiveMembership(): bool {
        $currentDate = new DateTime();
        return ($this->membershipEndDate && $currentDate <= $this->membershipEndDate);
    }
    
    public function canBorrow() : bool {
        if ($this->hasActiveMembership()) return true;
        // todo later : check currentBorrowedCount against limit 
        return false;
    }

    public function returnBook() {
        // to do :
    }

    abstract public function renewMembership();
}
