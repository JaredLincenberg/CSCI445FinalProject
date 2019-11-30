

CREATE DATABASE IF NOT EXISTS minerDB;

CREATE TABLE IF NOT EXISTS users (
	userID int NOT NULL AUTO_INCREMENT,
	FirstName varchar(255),
	LastName varchar(255),
	Email varchar(255),
	Password blob,
	PRIMARY KEY(userID)
);

CREATE TABLE IF NOT EXISTS admins (
	adminID int NOT NULL AUTO_INCREMENT,
	userID int,
	PRIMARY KEY (adminID),
	FOREIGN KEY(userID) REFERENCES users(userID)
);

CREATE TABLE IF NOT EXISTS posts (
	postID int NOT NULL AUTO_INCREMENT,
	userID int,
	Title varchar(255),
	Content TEXT,
	TimeCreated TIMESTAMP,
	PRIMARY KEY( postID ),
	FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE IF NOT EXISTS comments (
	commentID int NOT NULL AUTO_INCREMENT,
	userID int NOT NULL,
	postID int NOT NULL,
	Content TEXT,
	TimeCreated TIMESTAMP,
	PRIMARY KEY( commentID, postID ),
	FOREIGN KEY (userID) REFERENCES users(userID),
	FOREIGN KEY (postID) REFERENCES posts(postID)
);
CREATE TABLE IF NOT EXISTS likes (
	likeID int NOT NULL AUTO_INCREMENT,
	userID int NOT NULL,
	postID int NOT NULL,
	TimeCreated TIMESTAMP,
	PRIMARY KEY( likeID, postID ),
	FOREIGN KEY (userID) REFERENCES users(userID),
	FOREIGN KEY (postID) REFERENCES posts(postID)
);
CREATE TABLE IF NOT EXISTS follower (
	followerID int NOT NULL,
	followeeID int NOT NULL,
	PRIMARY KEY( followerID, followeeID ),
	FOREIGN KEY (followerID) REFERENCES users(userID),
	FOREIGN KEY (followeeID) REFERENCES users(userID)
);
--
INSERT INTO users (FirstName, LastName, Email, Password) 
VALUES("Jared","Lincenberg","Jaredlincenberg@mymail.mines.edu","$2y$12$u6LIqo6JcUArvX.8a2/jGuTWntBMBDhW.zYymyT87K1iuKcf/ZR161");
INSERT INTO admins (userID) 
VALUES(1);
