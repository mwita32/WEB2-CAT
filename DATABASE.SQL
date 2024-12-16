CREATE DATABASE user_details;
USE user_details;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREAMENT,
    username VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);