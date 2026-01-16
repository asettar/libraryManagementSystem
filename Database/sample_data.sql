INSERT INTO books (isbn, title, publication_year, category, branch_id, status) VALUES
('9780132350884', 'Clean Code', 2008, 'Programming', 1, 'available'),
('9780201633610', 'Design Patterns', 1994, 'Software Engineering', 1, 'checked_out'),
('9780131103627', 'The C Programming Language', 1988, 'Programming', 2, 'reserved'),
('9780262033848', 'Introduction to Algorithms', 2009, 'Algorithms', 2, 'available'),
('9780134685991', 'Effective Java', 2018, 'Programming', 1, 'lost');


INSERT INTO branches (name, location) VALUES
('Main Branch', 'Central Library – Ground Floor'),
('Reference Section', 'Central Library – First Floor'),
('Science & Technology', 'Central Library – Second Floor'),
('Literature & Arts', 'Central Library – West Wing'),
('Children’s Library', 'Central Library – East Wing'),
('Digital Media', 'Central Library – Third Floor'),
('Archives & Rare Books', 'Central Library – Basement');
