INSERT INTO branches (name, location) VALUES
('Main Branch', 'Central Library – Ground Floor'),
('Reference Section', 'Central Library – First Floor'),
('Science & Technology', 'Central Library – Second Floor'),
('Literature & Arts', 'Central Library – West Wing'),
('Children’s Library', 'Central Library – East Wing'),
('Digital Media', 'Central Library – Third Floor'),
('Archives & Rare Books', 'Central Library – Basement');

-- ==========================
-- Books (unique ISBN for each copy/branch)
-- ==========================
INSERT INTO books (isbn, title, publication_year, category, branch_id, status) VALUES
('9780132350884', 'Clean Code', 2008, 'Programming', 1, 'available'),
('9780132350885', 'Clean Code', 2008, 'Programming', 2, 'checked_out'),
('9780132350886', 'Clean Code', 2008, 'Programming', 3, 'available'),

('9780201633610', 'Design Patterns', 1994, 'Software Engineering', 1, 'checked_out'),

('9780131103627', 'The C Programming Language', 1988, 'Programming', 2, 'reserved'),
('9780131103628', 'The C Programming Language', 1988, 'Programming', 1, 'available'),

('9780262033848', 'Introduction to Algorithms', 2009, 'Algorithms', 2, 'available'),

('9780262033850', 'Introduction to Algorithms 2', 2010, 'Algorithms', 2, 'available'),
('9780262033851', 'Introduction to Algorithms 2', 2010, 'Algorithms', 3, 'available'),

('9780134685991', 'Effective Java', 2018, 'Programming', 1, 'lost'),
('9780134685992', 'Effective Java', 2018, 'Programming', 2, 'available');


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


