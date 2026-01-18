<?php 

namespace src\services;
use src\repositories\{MemberRepository, BorrowRepository, BookRepository};

class BorrowService {
        private MemberRepository $memberRepo;
        private BorrowRepository $borrowRepo;
        private BookRepository   $bookRepo;
        
        public function __construct(MemberRepository $memberRepo, BorrowRepository $borrowRepo, BookRepository   $bookRepo) {
                $this->memberRepo = $memberRepo;
                $this->borrowRepo = $borrowRepo;
                $this->bookRepo = $bookRepo;
        }

        // borrowBook(memberId, branchId, bookIsbn) {
        //     // validate member, branch, book
        //     // check bookavailability
        //     // borrowRepo->createborrowRecod
        // }
        //  renewBook(memberId, bookIsbn) {
        //     validate member, book
                // check if member can renew book(
                        // book is not renewed yet 
                        // status is checkedout(no reserve yet)
                        // no overdue books (from borrowRepository)   
                // delete previous borrowRecord
                // createNewBorrowRecord()
        // } 

        // returnBook(memberId, bookIsbn) {
                // check member and bookIsbn 
                // calculate latefees if there exist
                // update member 
                // update book status -> available
        // }
}

?>