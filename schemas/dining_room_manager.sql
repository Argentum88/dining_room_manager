-- Generated by SQL Maestro for MySQL. Release date 03.02.2014
-- 25.04.2014 8:39:22
-- ----------------------------------
-- Alias: dining_room_manager at localhost
-- Database name: dining_room_manager
-- Host: localhost
-- Port number: 3306
-- User name: root
-- Server: 5.6.15
-- Session ID: 19
-- Character set: utf8
-- Collation: utf8_general_ci


CREATE DATABASE dining_room_manager
  CHARACTER SET utf8
  COLLATE utf8_general_ci;

USE dining_room_manager;

/* Tables */
CREATE TABLE item (
  id            int AUTO_INCREMENT NOT NULL,
  name          varchar(120) NOT NULL,
  item_type_id  int NOT NULL,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE item_type (
  id      int AUTO_INCREMENT NOT NULL,
  name    varchar(120) NOT NULL,
  parent  int,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE `user` (
  id          int AUTO_INCREMENT NOT NULL,
  `password`  char(32) NOT NULL,
  email       varchar(70) NOT NULL,
  role        enum ('user','cook') NOT NULL DEFAULT user,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE user_item (
  user_id  int NOT NULL,
  item_id  int NOT NULL,
  PRIMARY KEY (user_id, item_id)
) ENGINE = InnoDB;

/* Indexes */
CREATE INDEX item_type
ON item
(item_type_id);

CREATE INDEX foreign_key01
ON item_type
(parent);

CREATE INDEX item_id
ON user_item
(item_id);

/* Foreign Keys */
ALTER TABLE item
ADD CONSTRAINT item_type
FOREIGN KEY (item_type_id)
REFERENCES item_type(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE item_type
ADD CONSTRAINT item_type_ibfk_1
FOREIGN KEY (parent)
REFERENCES item_type(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE user_item
ADD CONSTRAINT item_id
FOREIGN KEY (item_id)
REFERENCES item(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

ALTER TABLE user_item
ADD CONSTRAINT user_id
FOREIGN KEY (user_id)
REFERENCES `user`(id)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

/* Data for table "item" */
INSERT INTO item (id, name, item_type_id) VALUES
(1, 'Мимоза', 7),
(2, 'Салат из свиного фарша с рисовой лапшой', 8),
(3, 'Щи', 11);


/* Data for table "item_type" */
INSERT INTO item_type (id, name, parent) VALUES
(6, 'Салаты', NULL),
(7, 'Холодные Салаты', 6),
(8, 'Горячие Салаты', 6),
(11, 'Супы', NULL),
(12, 'Гарниры', NULL);


/* Data for table "user" */
INSERT INTO `user` (id, `password`, email, role) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'andreyevpv@mail.ru', 'user'),
(2, 'e3e90fd6d2a7c4661a1a3acf2f60bc6d', 'cook@mail.ru', 'cook');


/* Data for table "user_item" */
