INSERT INTO branches (name, location) VALUES
('Main Branch', 'Central Library – Ground Floor'),
('Reference Section', 'Central Library – First Floor'),
('Science & Technology', 'Central Library – Second Floor'),
('Literature & Arts', 'Central Library – West Wing'),
('Children’s Library', 'Central Library – East Wing'),
('Digital Media', 'Central Library – Third Floor'),
('Archives & Rare Books', 'Central Library – Basement');

INSERT INTO books (isbn, title, publication_year, category, branch_id, status, is_renewed) VALUES
('9780132350884', 'Clean Code', 2008, 'Programming', 1, 'available', 0),
('9780132350885', 'Clean Code', 2008, 'Programming', 2, 'checked_out', 0),
('9780132350886', 'Clean Code', 2008, 'Programming', 3, 'available', 0),

('9780201633610', 'Design Patterns', 1994, 'Software Engineering', 1, 'checked_out', 0),

('9780131103627', 'The C Programming Language', 1988, 'Programming', 2, 'reserved', 0),
('9780131103628', 'The C Programming Language', 1988, 'Programming', 1, 'available', 0),

('9780262033848', 'Introduction to Algorithms', 2009, 'Algorithms', 2, 'available', 0),

('9780262033850', 'Introduction to Algorithms 2', 2010, 'Algorithms', 2, 'available', 0),
('9780262033851', 'Introduction to Algorithms 2', 2010, 'Algorithms', 3, 'available', 0),

('9780134685991', 'Effective Java', 2018, 'Programming', 1, 'lost', 0),
('9780134685992', 'Effective Java', 2018, 'Programming', 2, 'available', 0);


INSERT INTO authors (name, biography, nationality, birth_date, death_date, primary_genre) VALUES
('George Orwell', 'English novelist, essayist, journalist, and critic.', 'British', '1903-06-25', '1950-01-21', 'Dystopian'),
('J.K. Rowling', 'British author, best known for the Harry Potter series.', 'British', '1965-07-31', NULL, 'Fantasy'),
('Haruki Murakami', 'Japanese writer of novels, short stories, and essays.', 'Japanese', '1949-01-12', NULL, 'Fiction'),
('Jane Austen', 'English novelist known primarily for her six major novels.', 'British', '1775-12-16', '1817-07-18', 'Romance'),
('Gabriel Garcia', 'Colombian novelist, short-story writer, screenwriter and journalist.', 'Colombian', '1927-03-06', '2014-04-17', 'Magic Realism');


INSERT INTO book_author (book_isbn, author_id) VALUES
-- Clean Code copies -> Haruki Murakami + Gabriel Garcia
('9780132350884', 3),
('9780132350884', 5),
('9780132350885', 3),
('9780132350885', 5),
('9780132350886', 3),
('9780132350886', 5),

-- Design Patterns -> George Orwell + J.K. Rowling
('9780201633610', 1),
('9780201633610', 2),

-- The C Programming Language copies -> Jane Austen only
('9780131103627', 4),
('9780131103628', 4),

-- Introduction to Algorithms -> Gabriel Garcia only
('9780262033848', 5),

-- Introduction to Algorithms 2 copies -> J.K. Rowling + Haruki Murakami
('9780262033850', 2),
('9780262033850', 3),
('9780262033851', 2),
('9780262033851', 3),

-- Effective Java copies -> George Orwell + Gabriel Garcia
('9780134685991', 1),
('9780134685991', 5),
('9780134685992', 1),
('9780134685992', 5);



INSERT INTO members
(name, email, phone_number, membership_end_date, current_borrowed_count, role, unpaid_fees)
VALUES
('Ali Hassan',   'ali@student.edu',    '0611111111', '2026-12-31', 0, 'student', 5.00),
('Sara Ahmed',   'sara@student.edu',   '0622222222', '2026-06-30', 1, 'student', 12.50),
('Omar Khaled',  'omar@faculty.edu',   '0633333333', '2027-12-31', 2, 'faculty', 0.00),
('Nadia Benali', 'nadia@faculty.edu',  '0644444444', NULL,        0, 'faculty', 8.75);


INSERT INTO borrow_records (book_isbn, member_id, borrow_date, due_date) VALUES
-- Students
('9780201633610', 2, '2026-01-10 14:30:00', '2026-01-24 14:30:00'),  -- Sara Ahmed

-- Faculty (Omar Khaled) with 2 borrows
('9780131103627', 3, '2026-01-10 09:00:00', '2026-02-09 09:00:00'),
('9780262033848', 3, '2026-01-12 11:00:00', '2026-02-11 11:00:00');