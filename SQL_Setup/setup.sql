-- -----------------------------------------------
-- Create Database
-- -----------------------------------------------

CREATE DATABASE IF NOT EXISTS minerDB;

-- -----------------------------------------------
-- Create Tables
-- -----------------------------------------------

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
-- -----------------------------------------------
-- Inserting data
-- -----------------------------------------------

-- Users
INSERT INTO users (FirstName, LastName, Email, Password) 
VALUES ("Jared","Lincenberg","Jaredlincenberg@mymail.mines.edu","$2y$12$u6LIqo6JcUArvX.8a2/jGuTWntBMBDhW.zYymyT87K1iuKcf/ZR161"),
("J", "L", "j@l.com", "$2y$12$A8g8XW7r6g/fM.OaxrTnx.55t99LjTti3WlJBGWP28QxrCZFDGbg.");

-- Admins
INSERT INTO admins (userID) 
VALUES(1);


-- Posts
INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (1,"My First Post", "This is the bestest website like ever", "2019-12-03 21:14:56");


INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (2,"My First Post","This my first post on my website. Hope this works out well!",CURRENT_TIMESTAMP);

INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (1,"Another Post", "This website keeps on getting better!", "2019-12-03 21:14:56");

-- Likes
INSERT INTO `likes`( `userID`, `postID`, `TimeCreated`) 
VALUES (2,1,CURRENT_TIMESTAMP);

-- Follows
INSERT INTO `follower`(`followerID`, `followeeID`) 
VALUES (2,1);

-- Comments
INSERT INTO `comments`( `userID`, `postID`, `Content`, `TimeCreated`) 
VALUES (1,2,"I believe it will",CURRENT_TIMESTAMP);

