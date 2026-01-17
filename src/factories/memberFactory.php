<?php 

namespace src\factories;

use DateTime;
use src\models\Member;
use src\models\FacultyMember;
use src\models\StudentMember;

class MemberFactory {
    public static function createFromArray(array $data): Member
    {
        $args = [$data['id'], $data['name'], $data['email'], $data['phone_number'],
                $data['membership_end_date'] ? new DateTime($data['membership_end_date']) : null, $data['current_borrowed_count']];

        switch ($data['role']) {
            case 'faculty':
                $member = new FacultyMember(...$args);
                break;

            case 'student':
               $member = new StudentMember(...$args);
                break;
        }
        return $member;
    }
}

?>

?>