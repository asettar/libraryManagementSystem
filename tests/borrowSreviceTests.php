<?php 

require_once __DIR__ . '/../vendor/autoload.php';
use src\models\Book;
use src\repositories\{BookRepository, MemberRepository, BorrowRepository, BranchRepository};
use src\repositories\mySqlConnection;
use src\services\{BorrowService};
use PHPUnit\Framework\TestCase;

class borrowSreviceTests extends TestCase {
    private $db;
    private $bookRepo;
    private $memberRepo;
    private $branchRepo;
    private $borrowRepo;
    private $borrowService;

    public function setUp() : void  {
        $this->db = new mySqlConnection();
        $this->bookRepo = new BookRepository($this->db);
        $this->memberRepo = new MemberRepository($this->db);
        $this->branchRepo = new BranchRepository($this->db);
        $this->borrowRepo = new borrowRepository($this->db);
        $this->borrowService = new BorrowService($this->memberRepo, $this->borrowRepo, $this->bookRepo, $this->branchRepo);
    }

    public function testBookNotFoundException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Book with isbn: 234234 not found.");
        $this->borrowService->borrowBook(1, 2, '234234');
    }

    public function testBranchNotFoundException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("branch with id : 1000 not found.");
        $this->borrowService->borrowBook(1, 1000, '9780262033851');
    }

    public function testMemberNotFoundException() {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Member with id : 2343 not found.");
        $this->borrowService->borrowBook(2343, 2, '9780262033851');
    }

    public function testMemberNotAvailable() {

    }

}

?>