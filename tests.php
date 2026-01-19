<?php 

require_once __DIR__ . '/vendor/autoload.php';

use src\models\Book;
use src\repositories\{BookRepository, MemberRepository};
use src\repositories\mySqlConnection;

function display(array $data) {
    foreach($data as $x) echo $x;
    echo "\n";
}
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
// echo ("======no authors found check\n");
// foreach($books as $book)
//     echo $book;

echo ("=== no book found check:======\n");
try {
    display($BookRepo->findByISBN('4534345'));
}catch(Exception $e) {echo $e->getMessage();};
try {
    display($BookRepo->findByTitle('4534345'));
}catch(Exception $e) {echo $e->getMessage();};
echo "Members ::\n";
echo "==========findMemberbyId============\n";
$memberRepo = new MemberRepository($db);
$member = $memberRepo->findById(1);
echo $member;
?>