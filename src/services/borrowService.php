<?php 

namespace src\services;

use src\factories\BorrowRecordFactory;
use src\models\{Book, BorrowRecord, Member, Branch};
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
    
    private function    updateReposOnSuccesfullBorrow(Book $book, Member $member, BorrowRecord $borrowRecord) : void {
        $this->bookRepo->update($book);
        $this->memberRepo->update($member);
        $this->borrowRepo->insert($borrowRecord);
    }
        
    public function borrowBook(int $memberId, int $branchId, string $bookIsbn) : BorrowRecord{
        $member = $this->memberRepo->findById($memberId);
        $branch = $this->branchRepo->findById($branchId);
        $book = $this->bookRepo->findByISBN($bookIsbn);
        
        if (!$member->canBorrow() || $this->borrowRepo->memberHasOverdueBooks($memberId))
            throw new \Exception("Member with id : $memberId is not available for borrowing.");
        
        if (!$book->isAvailable())
            throw new \Exception("Book with isbn : $bookIsbn is currently not available.");
        
        $book->setStatus('checked_out');
        $member->incrementCurrentBorrows();
        $borrowRecord = BorrowRecordFactory::createFromArray(
            [
                'book_isbn' => $bookIsbn,
                'member_id' => $member->getId(),
                'borrow_date' => (new DateTime())->format('Y-m-d H:i:s'),
                'due_date' => (new DateTime())->modify("+{$member->getLoanPeriod()} days")->format('Y-m-d H:i:s'),
            ]
        );
        $this->updateReposOnSuccesfullBorrow($book, $member, $borrowRecord);    
        return $borrowRecord;
    }
    
    public function returnBook(int $memberId, string $bookIsbn) {
        $borrowRecord = $this->borrowRepo->find($bookIsbn, $memberId);
        $book = $this->bookRepo->findByISBN($bookIsbn);
        $member = $this->memberRepo->findById($memberId);
        
        // delete from borrowing records
        $this->borrowRepo->delete($bookIsbn, $memberId);
        // update fees if latereturn
        $member->returnBook($borrowRecord->getDueDate());
        $this->memberRepo->update($member);
        
        // updateBook
        if ($book->getStatus() !== 'reserved')
            $book->setStatus('available');
        $book->unrenew();
        $this->bookRepo->update($book);
    }
        
    // public function renewBook(int $memberId, string $bookIsbn) {
        // $book = $this->bookRepo->findByISBN($bookIsbn);
        // validate member, book
        //             book is not renewed yet 
        //             status is checkedout(no reserve yet)
        //             no overdue books (from borrowRepository)   
        //     delete previous borrowRecord
        //     createNewBorrowRecord()
    // } 
}

?>