CREATE DATABASE novel_collection;
USE novel_collection;

CREATE TABLE novels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    publication_year INT,
    description TEXT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO novels (title, author, genre, publication_year, description, rating) VALUES
('Pride and Prejudice', 'Jane Austen', 'Romance', 1813, 'A classic romance novel...', 5),
('The Night Circus', 'Erin Morgenstern', 'Fantasy', 2011, 'A magical circus story...', 4),
('Gone Girl', 'Gillian Flynn', 'Thriller', 2012, 'A psychological thriller...', 3);
