<?php

namespace src\models;

use DateTime;

class StudentMember extends Member
{
    public function __construct(int $id, string $name, string $email, string $phoneNumber, ?DateTime $membershipEndDate)
    {
        parent::__construct($id, $name, $email, $phoneNumber, $membershipEndDate);
        $this->borrowLimit = 3;
        $this->loanPeriod = 14;
        $this->lateFee = 0.50;        
    }

    public function renewMembership(): void {
        $this->membershipEndDate = (new DateTime())->modify('+1 year');
    }
}
