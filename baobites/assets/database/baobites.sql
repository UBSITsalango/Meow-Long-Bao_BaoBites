CREATE DATABASE IF NOT EXISTS baobites;
USE baobites;

CREATE TABLE users (
 user_id INT AUTO_INCREMENT PRIMARY KEY,
 first_name VARCHAR(50),
 last_name VARCHAR(50),
 username VARCHAR(50) UNIQUE,
 email VARCHAR(100) UNIQUE,
 password VARCHAR(255),
 role ENUM('admin','user') DEFAULT 'user',
 joined_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE recipes (
 recipe_id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(80),
 ingredients TEXT,
 instructions TEXT,
 category ENUM('Main Dish','Dessert','Snack','Beverage','Other'),
 created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
 updated_at DATETIME NULL,
 user_id INT,
 FOREIGN KEY(user_id) REFERENCES users(user_id)
);

CREATE TABLE comment (
 comment_id INT AUTO_INCREMENT PRIMARY KEY,
 content TEXT,
 created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
 user_id INT,
 recipe_id INT,
 FOREIGN KEY(user_id) REFERENCES users(user_id),
 FOREIGN KEY(recipe_id) REFERENCES recipes(recipe_id)
);

CREATE TABLE rating (
 rating_id INT AUTO_INCREMENT PRIMARY KEY,
 score INT CHECK(score BETWEEN 1 AND 5),
 created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
 user_id INT,
 recipe_id INT,
 UNIQUE(user_id,recipe_id),
 FOREIGN KEY(user_id) REFERENCES users(user_id),
 FOREIGN KEY(recipe_id) REFERENCES recipes(recipe_id)
);

CREATE TABLE favorite (
 favorite_id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 recipe_id INT,
 UNIQUE(user_id,recipe_id),
 FOREIGN KEY(user_id) REFERENCES users(user_id),
 FOREIGN KEY(recipe_id) REFERENCES recipes(recipe_id)
);