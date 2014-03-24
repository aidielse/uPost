DROP DATABASE IF EXISTS uPost;

CREATE DATABASE uPost;

USE uPost;

DROP TABLE IF EXISTS Users CASCADE;

CREATE TABLE Users (

	userId INT PRIMARY KEY AUTO_INCREMENT
);

CREATE TABLE Facebook (

	facebookId INT PRIMARY KEY,
	userId INT,
	accessToken TEXT(512),

	FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE
);

CREATE TABLE Twitter (

	twitterId INT PRIMARY KEY,
	userId INT,
	accessToken TEXT(512),

	FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE
);

CREATE TABLE GooglePlus (

	googlePlusId INT PRIMARY KEY,
	userId INT,
	accessToken TEXT(512),

	FOREIGN KEY (userId) REFERENCES Users(userId) ON DELETE CASCADE
);
GRANT ALL ON uPost.* to 'phpuser1'@'localhost';

SET PASSWORD FOR 'phpuser1'@'localhost' = PASSWORD('phppass');