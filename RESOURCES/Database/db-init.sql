DROP DATABASE IF EXISTS upost;

CREATE DATABASE upost;

USE upost;

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users (

	userId INT PRIMARY KEY AUTO_INCREMENT,
	userName VARCHAR(255) UNIQUE NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE sessions (

	sessionId INT PRIMARY KEY AUTO_INCREMENT,
	userId INT,
	token VARCHAR(255),
	tokenIdentifier VARCHAR(1),

	FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE
);

GRANT ALL ON upost.* to 'phpuser1'@'localhost';

SET PASSWORD FOR 'phpuser1'@'localhost' = PASSWORD('phppass');