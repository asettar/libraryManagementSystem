<?php

namespace src\models;

use DateTime;

class FacultyMember extends Member
{
    public function __construct(int $id, string $name, string $email, string $phoneNumber, ?DateTime $membershipEndDate)
    {
        parent::__construct($id, $name, $email, $phoneNumber, $membershipEndDate);
        $this->borrowLimit = 10;
        $this->loanPeriod = 30;
        $this->lateFee = 0.25;
    }

    public function renewMembership(): void {
        $this->membershipEndDate = (new DateTime())->modify('+3 years');
    }
}
