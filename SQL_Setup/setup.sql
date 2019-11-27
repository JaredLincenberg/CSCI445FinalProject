

CREATE DATABASE IF NOT EXISTS minerDB;

CREATE TABLE IF NOT EXISTS user (
	userID int NOT NULL AUTO_INCREMENT,
	FirstName varchar(255),
	LastName varchar(255),
	Email varchar(255),
	PRIMARY KEY(userID)
);

CREATE TABLE IF NOT EXISTS admin (
	adminID int NOT NULL AUTO_INCREMENT,
	userID int,
	PRIMARY KEY (adminID),
	FOREIGN KEY(userID) REFERENCES user(userID)
);

CREATE TABLE IF NOT EXISTS post (
	postID int NOT NULL AUTO_INCREMENT,
	userID int,
	Title varchar(255),
	Content TEXT,
	Image varchar(1000),
	TimeCreated TIMESTAMP,
	PRIMARY KEY( postID ),
	FOREIGN KEY (userID) REFERENCES user(userID)
);

CREATE TABLE IF NOT EXISTS comment (
	commentID int NOT NULL AUTO_INCREMENT,
	userID int NOT NULL,
	postID int NOT NULL,
	Content TEXT,
	TimeCreated TIMESTAMP,
	PRIMARY KEY( commentID, postID ),
	FOREIGN KEY (userID) REFERENCES user(userID),
	FOREIGN KEY (postID) REFERENCES post(postID)
);
CREATE TABLE IF NOT EXISTS likes (
	likeID int NOT NULL AUTO_INCREMENT,
	userID int NOT NULL,
	postID int NOT NULL,
	TimeCreated TIMESTAMP,
	PRIMARY KEY( likeID, postID ),
	FOREIGN KEY (userID) REFERENCES user(userID),
	FOREIGN KEY (postID) REFERENCES post(postID)
);
CREATE TABLE IF NOT EXISTS follower (
	followerID int NOT NULL,
	followeeID int NOT NULL,
	PRIMARY KEY( followerID, followeeID ),
	FOREIGN KEY (followerID) REFERENCES user(userID),
	FOREIGN KEY (followeeID) REFERENCES user(userID)
);

INSERT INTO user (FirstName, LastName, Email) 
VALUES("Jared","Lincenberg","Jaredlincenberg@mymail.mines.edu");
INSERT INTO admin (userID) 
VALUES(1);
