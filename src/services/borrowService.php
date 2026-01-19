<?php 

namespace src\services;

use src\factories\BorrowRecordFactory;
use src\models\{Book, Member, Branch};
use src\repositories\{MemberRepository, BorrowRepository, BookRepository, BranchRepository};
use DateTime;

class BorrowService {
    private MemberRepository    $memberRepo;
    private BorrowRepository    $borrowRepo;
    private BookRepository      $bookRepo;
    private BranchRepository    $branchRepo;
    
    public function __construct(MemberRepository $memberRepo, BorrowRepository $borrowRepo,
                    BookRepository $bookRepo, BranchRepository $branchRepo) {
        $this->memberRepo = $memberRepo;
        $this->borrowRepo = $borrowRepo;
        $this->bookRepo = $bookRepo;
        $this->bookRepo = $bookRepo;
        $this->branchRepo = $branchRepo;
    }
    
    private function addBorrowRecord($bookIsbn, $memberId) {
        $borrowRecord = BorrowRecordFactory::createFromArray(
            [
                'book_isbn' => $bookIsbn,
                'member_id' => $memberId,
                'borrow_date' => (new DateTime())->format('Y-m-d H:i:s'),
                'due_date' => (new DateTime())->modify("+{$memberId->getLoanPeriod()} days")->format('Y-m-d H:i:s'),
            ]
        );

        $this->borrowRepo->insert($borrowRecord);
        echo $borrowRecord; 
    }

    public function borrowBook(int $memberId, int $branchId, string $bookIsbn) {
        $member = $this->memberRepo->findById($memberId);
        $branch = $this->branchRepo->findById($branchId);
        $book = $this->bookRepo->findByISBN($bookIsbn);

        if (!$member->canBorrow() || $this->borrowRepo->memberHasOverdueBooks($memberId))
            throw new \Exception("Member with id : $memberId is not available for borrowing");
        
        if (!$book->isAvailable())
            throw new \Exception("Book with isbn : $bookIsbn is currently not available.");
        
        // update 
        $book->setStatus('checked_out');
        $member->incrementCurrentBorrows(); 
        $this->bookRepo->update($book);
        $this->memberRepo->update($member);

        // createRecord
        $this->addBorrowRecord($memberId, $bookIsbn);
    }
        
        
        
        //  renewBook(memberId, bookIsbn) {
        //     validate member, book
                        // book is not renewed yet 
                        // status is checkedout(no reserve yet)
                        // no overdue books (from borrowRepository)   
                // delete previous borrowRecord
                // createNewBorrowRecord()
        // } 

        // returnBook(memberId, bookIsbn) {
                // calculate latefees if there exist
                // update member 
                // update book status -> available
        // }
}

?>