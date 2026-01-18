<?php

namespace src\factories;

use src\models\Branch;

class BranchFactory {
    public static function createFromArray(array $data): Branch
    {
        return new Branch(
            $data['id'],
            $data['name'],
            $data['location'],
            $data['operating_hours']
        );
    }
}
?>
