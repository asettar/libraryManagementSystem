<?php 

namespace src\factories;
use src\models\Book;

class BookFactory {
    public static function createFromArray(array $data): Book
    {
        return new Book(
            $data['isbn'],
            $data['title'],
            $data['publication_year'],
            $data['category'],
            $data['branch_id'],
            $data['status']
        );
    }
}

?>