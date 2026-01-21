<?php 

namespace src\services;

use src\models\{Member};
use src\repositories\{MemberRepository};
use DateTime;
use Exception;
use PDOException;

class ManagementService {
    private MemberRepository    $memberRepo;
    
    public function __construct(MemberRepository $memberRepo) {
        $this->memberRepo = $memberRepo;
    }
    

    public function renewMembership(int $memberId) : void {
        $member = $this->memberRepo->findById($memberId);
        $member->renewMembership();
        $this->memberRepo->update($member);
    }

    public function updateMemberContact(int $memberId, string $phoneNumber, string $email) : void {
        $member = $this->memberRepo->findById($memberId);
        $member->setPhoneNumber($phoneNumber);
        $member->setEmail($email);
        $this->memberRepo->update($member);
    }
    
    //  payFees(memberId) 

    public function registerNewMember() : void {

    }

}

// libraryService {
//     managementService
//     borrowService
//     reservationService
    // return
// }
?>
