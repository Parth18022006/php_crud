DROP DATABASE IF EXISTS PRACTICE;

CREATE DATABASE PRACTICE;

USE PRACTICE;

CREATE TABLE `USER`(
    id int AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    Password varchar(255) NOT NULL,
    Role ENUM('Admin','User') NOT NULL DEFAULT 'User'
);

INSERT INTO `user` (`id`, `email`, `Password`, `Role`) VALUES (NULL, 'admin@gmail.com', '12345', 'Admin');

CREATE TABLE category(
    c_id int AUTO_INCREMENT PRIMARY KEY,
    cname varchar(255) NOT NULL
);

CREATE TABLE product(
    pid int AUTO_INCREMENT PRIMARY KEY,
    pname varchar(255) NOT NULL,
    price varchar(255) NOT NULL,
    cid int,
    FOREIGN KEY (cid) REFERENCES category(c_id)
)

