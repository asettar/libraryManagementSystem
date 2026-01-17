CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(150) NOT NULL
);


CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    publication_year YEAR NOT NULL,
    category VARCHAR(100) NOT NULL,
    branch_id INT NOT NULL,
    status ENUM('available', 'checked_out', 'reserved', 'lost') 
           NOT NULL DEFAULT 'available',

    FOREIGN KEY (branch_id) REFERENCES branches(id)
);

CREATE TABLE authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    biography TEXT NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    birth_date DATETIME NOT NULL,
    death_date DATETIME,
    primary_genre VARCHAR(100) NOT NULL
);


CREATE TABLE book_author (
    book_isbn VARCHAR(255) NOT NULL,
    author_id INT NOT NULL,
    PRIMARY KEY (book_isbn, author_id),
    FOREIGN KEY (book_isbn) REFERENCES books(isbn) ON DELETE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
);


-- members
CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone_number VARCHAR(50) NOT NULL,
    membership_end_date DATETIME DEFAULT NULL,
    current_borrowed_count INT NOT NULL DEFAULT 0,
    loan_period INT NOT NULL,
    late_fee FLOAT NOT NULL,  -- fee per day
    borrow_limit INT NOT NULL,
    role ENUM('faculty', 'student') NOT NULL
);
