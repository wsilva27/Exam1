CREATE DATABASE registration;

USE registration;

DROP TABLE IF EXISTS user_info;

CREATE TABLE  user_info (
    email         VARCHAR(50)  NOT NULL,
    username      VARCHAR(50)  NOT NULL,
    password      VARCHAR(255) NOT NULL,
    first_name    VARCHAR(50)  NOT NULL,
    last_name     VARCHAR(50)  NOT NULL,
    city          VARCHAR(50)  DEFAULT NULL,
    state         CHAR(2)      DEFAULT NULL,
    hobbies       VARCHAR(255) DEFAULT NULL,
    id            INT(10)      NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
);

INSERT INTO user_info (username, password, first_name, last_name, email, city, state)
VALUES ('john','smith','John','Smith','jsmith@company.com','Brooklyn','NY');
