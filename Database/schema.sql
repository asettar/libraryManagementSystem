CREATE TABLE branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(150) NULL
);


CREATE TABLE books (
    isbn VARCHAR(20) PRIMARY KEY,
    title VARCHAR(255)  UNIQUE NOT NULL,
    publication_year YEAR NOT NULL,
    category VARCHAR(100) NOT NULL,
    branch_id INT NOT NULL,
    status ENUM('available', 'checked_out', 'reserved', 'lost') 
           NOT NULL DEFAULT 'available'

    FOREIGN KEY (branch_id) REFERENCES branches(id)
);

