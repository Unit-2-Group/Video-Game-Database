DROP DATABASE IF EXISTS videogame_db;

CREATE DATABASE videogame_db;
USE videogame_db;

-- Table 1: genres
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Table 2: games
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    genre_id INT,
    release_date DATE,
    FOREIGN KEY (genre_id) REFERENCES genres(id)
);

-- Table 3: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Table 4: reviews
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT,
    user_id INT,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    review_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (game_id) REFERENCES games(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO genres (name) VALUES 
('Action'),
('Adventure'),
('RPG'),
('Simulation'),
('Strategy'),
('Sports'),
('Puzzle'),
('Horror');
