<?php 

namespace src\services;

use src\models\{Member};
use src\repositories\{MemberRepository};
use DateTime;
use Exception;

class ManagementService {
    private MemberRepository    $memberRepo;
    
    public function __construct(MemberRepository $memberRepo) {
        $this->memberRepo = $memberRepo;
    }
    
    // renewMembership(memberID);
    // updateContact(memberId);
    //  payFees(memberId) 

    public function renewMembership(int $memberId) : void {
        $member = $this->memberRepo->findById($memberId);
        $member->renewMembership();
        $this->memberRepo->update($member);
    }

    public function updateContact(int $memberId) : void {

    }

    public function regiterNewMember() : void {

    }

}

// libraryService {
//     managementService
//     borrowService
//     reservationService
    // return
// }
?>
