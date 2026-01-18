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
    protected float     $unpaidFees;
    protected int       $loanPeriod;
    protected float     $lateFee;
    protected int       $borrowLimit;

    public function __construct(int $id, string $name, string $email, string $phoneNumber, ?DateTime $membershipEndDate,
            int $currentBorrowedCount, float $unpaidFees) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->membershipEndDate = $membershipEndDate;
        $this->currentBorrowedCount = $currentBorrowedCount;
        $this->unpaidFees = $unpaidFees;
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

    public function getUnpaidFees() : ? float {
        return $this->unpaidFees;
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

    public function getChangeableData() : array {
        return [
            'phone_number '          => $this->phoneNumber,
            'membership_end_date'    => $this->membershipEndDate ? $this->membershipEndDate->format('Y-m-d H:i:s') : null, 
            'current_borrowed_count' => $this->currentBorrowedCount,
            'unpaid_fees'            => $this->unpaidFees
        ];
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
    
    public function __toString() : string {
        return "id :{$this->id}, name: {$this->name}, email: {$this->email},
                membershipEndDate: {$this->membershipEndDate->format('Y-m-d')},
                currentBorrowedCount : {$this->currentBorrowedCount}, 
                unpaidFees : {$this->unpaidFees}";
    }
    
    abstract public function renewMembership();
}
