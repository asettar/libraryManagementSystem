<?php 

require_once __DIR__ . '/vendor/autoload.php';

use src\models\Book;
use src\repositories\BookRepository;
use src\repositories\mySqlConnection;

// db Connection;
$db = new mySqlConnection();
echo "database is succesfully connected" . PHP_EOL;

// Book repository;
$BookRepo = new BookRepository($db);

// findBYISBN method:
echo("===FindByISBN==========\n");
$book = $BookRepo->findByISBN('9780132350884');
echo($book);
$book = $BookRepo->findByTitle('Clean Code');
echo("===FindByTitle==========\n");
echo $book;

$books = $BookRepo->findByCategory('Programming');
echo("===FindByCategory==========\n");
foreach($books as $book)
    echo $book;


?>