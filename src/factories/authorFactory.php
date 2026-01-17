<?php

namespace src\factories;

use src\models\Author;
use DateTime;

class AuthorFactory {
    public static function createFromArray(array $data): Author {
        return new Author(
            $data['id'],
            $data['name'],
            $data['biography'],
            $data['nationality'],
            $data['primary_genre'],
            new DateTime($data['birth_date']),
            $data['death_date'] ? new DateTime($data['death_date']) : null);
    }
}
