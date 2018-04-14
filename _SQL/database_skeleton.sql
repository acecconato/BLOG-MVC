SET NAMES "UTF8";

-- -----------------------
-- Database creation
-- -----------------------
DROP DATABASE IF EXISTS perso_blog;
CREATE DATABASE perso_blog CHARACTER SET "UTF8MB4" COLLATE utf8mb4_general_ci;

USE perso_blog;

-- -----------------------
-- Users table creation
-- -----------------------
DROP TABLE IF EXISTS users;
CREATE TABLE users
(
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  permissionLevel SMALLINT UNSIGNED NOT NULL DEFAULT 1,
  email VARCHAR(255) NOT NULL,
  pseudo VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id),
  UNIQUE INDEX ind_email (email),
  UNIQUE INDEX ind_pseudo(pseudo)
)ENGINE=InnoDB;

-- -----------------------
-- Comments table creation
-- -----------------------
DROP TABLE IF EXISTS comments;
CREATE TABLE comments
(
  comment_id INT UNSIGNED AUTO_INCREMENT,
  content TEXT NOT NULL,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  reason VARCHAR(255),
  post_id INT UNSIGNED NOT NULL,
  status_id INT UNSIGNED DEFAULT 1,
  author VARCHAR(100) NOT NULL ,
  PRIMARY KEY (comment_id)
)ENGINE=InnoDB;

-- -----------------------
-- Status table creation
-- -----------------------
DROP TABLE IF EXISTS status;
CREATE TABLE status
(
  status_id INT UNSIGNED AUTO_INCREMENT,
  label VARCHAR(20) NOT NULL,
  PRIMARY KEY (status_id)
)ENGINE=InnoDB;

-- -----------------------
-- Posts table creation
-- -----------------------
DROP TABLE IF EXISTS posts;
CREATE TABLE posts
(
  post_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  creationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  picture VARCHAR(50),
  lastUpdate TIMESTAMP,
  user_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (post_id),
  INDEX ind_lastUpdate (lastUpdate),
  FULLTEXT INDEX ind_full_title (title),
  FULLTEXT INDEX ind_full_content (content),
  FULLTEXT INDEX ind_full_title_content (title, content)
)ENGINE=InnoDB;

-- -----------------------
-- Create the foreign keys
-- -----------------------

-- Posts -> Users
ALTER TABLE posts
  ADD CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES users(user_id)
  ON UPDATE CASCADE;

-- Comments -> Status
ALTER TABLE comments
  -- If the status is deleted, all attached comments id are set to NULL.
  -- If the status is updated, all attached comments id are updated too.
  ADD CONSTRAINT fk_status_id FOREIGN KEY (status_id) REFERENCES status(status_id)
  ON DELETE SET NULL
  ON UPDATE CASCADE;

-- Comments -> Posts
ALTER TABLE comments
  -- If the post is deleted, all attached comments are deleted too.
  -- If the post id is updated, all attached comments id are updated too.
  ADD CONSTRAINT fk_post_id FOREIGN KEY (post_id) REFERENCES posts(post_id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;