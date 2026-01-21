<?php 

require_once __DIR__ . '/../vendor/autoload.php';
use src\models\Book;
use src\repositories\{BookRepository, MemberRepository, BorrowRepository, BranchRepository};
use src\repositories\mySqlConnection;
use src\services\{BorrowService};
use PHPUnit\Framework\TestCase;
use src\factories\BorrowRecordFactory;
use src\models\BorrowRecord;

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
        $this->db->beginTransaction();
    }

    public function tearDown(): void {
        $this->db->rollBack();
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
    
    public function testMemberNotAvailableException() {
        // unpaid fees > 10 for member with id = 2;
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Member with id : 2 is not available for borrowing.");
        $this->borrowService->borrowBook(2, 1, '9780131103628');
    }

    public function testBookUnavailableException() {
        // book status != available
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Book with isbn : 9780131103627 is currently not available.");
        $this->borrowService->borrowBook(1, 2, '9780131103627');
    }

    public function testSuccessfullBorrow() {
        $prevMember =  $this->memberRepo->findById(3);
        $this->borrowService->borrowBook(3, 1, '9780131103628');
        $this->borrowRepo->find('9780131103628', 3);  // no exception should be thrown
        
        $book = $this->bookRepo->findByISBN('9780131103628'); 
        $member = $this->memberRepo->findById(3);
        $this->assertEquals($book->getStatus(), 'checked_out');
        // echo ($book);
        // echo $member;
        // echo $prevMember;
        $this->assertEquals($member->getCurrentBorrowedCount(), $prevMember->getCurrentBorrowedCount() + 1);
        // BorrowRecord
    }

    // return book tests
    public function testrecordDeletionOnBookReturn() {
        $this->borrowRepo->find('9780201633610', 2);  // no exception throw 
        $this->borrowService->returnBook(2, '9780201633610'); // no exception
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("borrow record not found");
        $this->borrowRepo->find('9780201633610', 2); 
    }

    public function testBookUdpatesOnBookReturn() {
        $borrowRecord = $this->borrowService->returnBook(2, '9780201633610'); // no exception

        $book = $this->bookRepo->findByISBN('9780201633610');
        $bookStatus = $book->getStatus();
        $this->assertNotEquals($bookStatus, 'checked_out');
        $this->assertTrue($bookStatus === 'reserved' || $bookStatus == 'available');
    }

    public function testMemberUdpatesOnBookReturn() {
        $member = $this->memberRepo->findById(2);
        $unpaidFees = $member->getUnpaidFees(); 
        $borrows = $member->getCurrentBorrowedCount(); 
        $this->borrowService->returnBook(2, '9780201633610'); // no exception

        $member = $this->memberRepo->findById(2);
        $this->assertEquals($member->getUnpaidFees(), $unpaidFees, "unpaid fees failed");
        $this->assertEquals($member->getCurrentBorrowedCount(), $borrows -1, "borrows count failed");
    }

}
?>