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
$books = $BookRepo->findByTitle('Clean Code');
echo("===FindByTitle==========\n");
foreach($books as $book)
    echo $book;

$books = $BookRepo->findByCategory('Programming');
echo("===FindByCategory==========\n");
foreach($books as $book)
    echo $book;

$books = $BookRepo->findByAuthor(3);
echo("===FindByAuthor==========\n");
foreach($books as $book)
    echo $book;
?>