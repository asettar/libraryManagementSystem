<?php

namespace src\models;

use DateTime;

class StudentMember extends Member
{
    public function __construct(int $id, string $name, string $email, string $phoneNumber, ?DateTime $membershipEndDate, int $currentBorrowedCount) {
        parent::__construct($id, $name, $email, $phoneNumber, $membershipEndDate, $currentBorrowedCount);
        $this->borrowLimit = 3;
        $this->loanPeriod = 14;
        $this->lateFee = 0.50;
    }

    public function renewMembership(): void {
        $this->membershipEndDate = (new DateTime())->modify('+1 year');
    }
}
