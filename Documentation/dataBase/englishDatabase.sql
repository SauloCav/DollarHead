create database quizGame;

use quizGame;

CREATE TABLE users (
    id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nickname VARCHAR(20) NOT NULL
);

CREATE TABLE questions_answer (
    id_question INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question varchar(100) NOT NULL,
    rigth_answer varchar(50) NOT NULL,
    answer_a varchar(50) NOT NULL,
	answer_b varchar(50) NOT NULL,
	answer_c varchar(50) NOT NULL,
    difficulty_index INT NOT NULL,
    topic_question varchar(20) NOT NULL,
	validate enum ('v','i') NOT NULL
);

CREATE TABLE denounce_validation (
    id_den_val INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    num_denounce INT NOT NULL,
    num_validation INT NOT NULL,
    username_1 varchar(50),
	username_2 varchar(50),
    id_question INT NOT NULL,
	FOREIGN KEY(id_question) references questions_answer(id_question)
);

CREATE TABLE stats (
	id_stats INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    num_games_played INT NOT NULL,
	award INT NOT NULL,
	num_use_two_alteratives INT NOT NULL,
    num_defeats_error INT NOT NULL,
	num_defeats_stop INT NOT NULL,
	num_contributions INT NOT NULL,
    user_level VARCHAR(50) NOT NULL,
    id_user_stats INT NOT NULL,
	FOREIGN KEY(id_user_stats) references users(id_user)
);

CREATE TABLE ranking (
    id_ranking INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    punctuation REAL NOT NULL,
    date_punctuation DATETIME DEFAULT CURRENT_TIMESTAMP,
	id_user INT NOT NULL,
	FOREIGN KEY(id_user references users(id_user)
);
