INSERT INTO branches (name, location) VALUES
('Main Branch', 'Central Library – Ground Floor'),
('Reference Section', 'Central Library – First Floor'),
('Science & Technology', 'Central Library – Second Floor'),
('Literature & Arts', 'Central Library – West Wing'),
('Children’s Library', 'Central Library – East Wing'),
('Digital Media', 'Central Library – Third Floor'),
('Archives & Rare Books', 'Central Library – Basement');

INSERT INTO books (isbn, title, publication_year, category, branch_id, status) VALUES
('9780132350884', 'Clean Code', 2008, 'Programming', 1, 'available'),
('9780201633610', 'Design Patterns', 1994, 'Software Engineering', 1, 'checked_out'),
('9780131103627', 'The C Programming Language', 1988, 'Programming', 2, 'reserved'),
('9780262033848', 'Introduction to Algorithms', 2009, 'Algorithms', 2, 'available'),
('9780262033850', 'Introduction to Algorithms 2', 2010, 'Algorithms', 2, 'available'),
('9780134685991', 'Effective Java', 2018, 'Programming', 1, 'lost');


INSERT INTO authors (name, biography, nationality, birth_date, death_date, primary_genre) VALUES
('George Orwell', 'English novelist, essayist, journalist, and critic.', 'British', '1903-06-25', '1950-01-21', 'Dystopian'),
('J.K. Rowling', 'British author, best known for the Harry Potter series.', 'British', '1965-07-31', NULL, 'Fantasy'),
('Haruki Murakami', 'Japanese writer of novels, short stories, and essays.', 'Japanese', '1949-01-12', NULL, 'Fiction'),
('Jane Austen', 'English novelist known primarily for her six major novels.', 'British', '1775-12-16', '1817-07-18', 'Romance'),
('Gabriel García Márquez', 'Colombian novelist, short-story writer, screenwriter and journalist.', 'Colombian', '1927-03-06', '2014-04-17', 'Magic Realism');