CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(150) NOT NULL
);


CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255)  UNIQUE NOT NULL,
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

