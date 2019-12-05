-- -----------------------------------------------
-- Create Database
-- -----------------------------------------------

CREATE DATABASE IF NOT EXISTS minerDB;
USE minerDB;
-- -----------------------------------------------
-- Create Tables
-- -----------------------------------------------

CREATE TABLE IF NOT EXISTS users (
	userID int NOT NULL AUTO_INCREMENT,
	FirstName varchar(255),
	LastName varchar(255),
	Email varchar(255),
	Verified BOOLEAN NOT NULL DEFAULT FALSE,
	Password blob,
	PRIMARY KEY(userID)
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
-- INSERT INTO users (FirstName, LastName, Email, Password, Verified) 
-- VALUES ("Jared","Lincenberg","Jaredlincenberg@mymail.mines.edu","$2y$12$u6LIqo6JcUArvX.8a2/jGuTWntBMBDhW.zYymyT87K1iuKcf/ZR161",true),
-- ("J", "L", "j@l.com", "$2y$12$A8g8XW7r6g/fM.OaxrTnx.55t99LjTti3WlJBGWP28QxrCZFDGbg.",true);
INSERT INTO `users` ( `FirstName`, `LastName`, `Email`, `Password`, `Verified`) VALUES
('Jared', 'Lincenberg', 'Jaredlincenberg@mymail.mines.edu', 0x2432792431322474645946763038774177762f4e644e53714167624d2e5a7354676836392e613253526c316977763438306764304132396871613343,true),
("J", "L", "j@l.com", "$2y$12$A8g8XW7r6g/fM.OaxrTnx.55t99LjTti3WlJBGWP28QxrCZFDGbg.",true),
('Trevor', 'Kerr', 'trevor.kerr97@gmail.com', 0x243279243132243548485548654e6c2e77642e5a396c6c65346c7830757733306d48745a6979633457514f2e4b506f39484d4f7932437557715a6c6d,true),
('Jared', 'Lincenbergs', 'jaredlincenberg@mines.edu', 0x2432792431322435714436383641536136703439736e424b53374f364f58494177552e6b324144654b31654950773837676c7354754457362f4b6d4f,true);



-- Posts
INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (1,"My First Post", "This is the bestest website like ever", "2019-12-03 21:14:56");


INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (2,"My First Post","This my first post on my website. Hope this works out well!",CURRENT_TIMESTAMP),
(2,"New post","Lots of Content Here",CURRENT_TIMESTAMP);

INSERT INTO `posts`(`userID`, `Title`, `Content`, `TimeCreated`) 
VALUES (1,"Another Post", "This website keeps on getting better!", "2019-12-03 21:14:56");

-- Posts From Dump
INSERT INTO `posts` (`userID`, `Title`, `Content`, `TimeCreated`) VALUES
( 2, 'Perimeter of an Ellipse', 'Not Easy to find', '2019-12-04 12:13:26'),
(4, 'Spirograph Stuff', 'FUN!!!', '2019-12-04 12:33:08');

-- Likes
INSERT INTO `likes`( `userID`, `postID`, `TimeCreated`) 
VALUES (2,1,CURRENT_TIMESTAMP);

-- SQL Dumped Likes
INSERT INTO `likes` ( `userID`, `postID`, `TimeCreated`) VALUES
( 2, 1, '2019-12-04 04:23:52'),
( 2, 2, '2019-12-04 06:26:27'),
( 1, 2, '2019-12-04 06:26:27'),
( 2, 2, '2019-12-05 01:37:01'),
( 3, 1, '2019-12-05 01:37:21');

-- Follows
-- INSERT INTO `follower`(`followerID`, `followeeID`) 
-- VALUES (2,1);

-- Comments
INSERT INTO `comments`( `userID`, `postID`, `Content`, `TimeCreated`) 
VALUES (1,2,"I believe it will",CURRENT_TIMESTAMP);

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` ( `userID`, `postID`, `Content`, `TimeCreated`) VALUES
( 1, 2, 'I believe it will', '2019-12-04 04:23:52'),
( 2, 2, 'Hello TO ME', '2019-12-04 06:33:00'),
( 1, 2, 'HI!!!!!!!!!!!!!!!!', '2019-12-04 06:33:00');


