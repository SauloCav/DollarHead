

CREATE TABLE denounce_validation (
    id_den_val INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    num_denounce INT NOT NULL,
    num_validation INT NOT NULL,
    username_1 varchar(50),
	username_2 varchar(50),
    id_question INT NOT NULL,
	FOREIGN KEY(id_question) references questions_answer(id_question)
);

	
	
create database quizGame;

CREATE TABLE Users (
	idUser INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	nickname VARCHAR(20) NOT NULL
);

CREATE TABLE Stats (
	idStats INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	numRoundsPlayed INT NOT NULL,
	totalPrize INT NOT NULL,
	numEliminationOfAlternatives INT NOT NULL,
	numLossesByMistake INT NOT NULL,
	numLossesByStop INT NOT NULL,
	numContributions INT NOT NULL,
	userLevel VARCHAR(50) NOT NULL,
	idUserStats INT NOT NULL,
	FOREIGN KEY(idUserStats) references users(idUser)
);

CREATE TABLE Ranking (
	idRanking INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	score REAL NOT NULL,
	scoreDateTime DATETIME DEFAULT CURRENT_TIMESTAMP,
	idUserRanking INT NOT NULL,
	FOREIGN KEY(idUserRanking) references users(idUser)
);

CREATE TABLE LatestScores (
	idLatestScores INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	prize01 INT,
	prize02 INT,
	prize03 INT,
	prize04 INT,
	prize05 INT,
	idUserLatestScores INT NOT NULL,
	FOREIGN KEY(idUserLatestScores) references users(idUser)
);

CREATE TABLE Questions (
	idQuestion INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	question varchar(100) NOT NULL,
	rigthAnswer varchar(50) NOT NULL,
	answerA varchar(50) NOT NULL,
	answerB varchar(50) NOT NULL,
	answerC varchar(50) NOT NULL,
	indice_dif INT NOT NULL,
	quest_topico varchar(20) NOT NULL,
	valida enum ('v','i') NOT NULL
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

CREATE TABLE denuncia_validacao (
    id_den_val INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    num_denuncias INT NOT NULL,
    num_validacoes INT NOT NULL,
    username_1 varchar(50),
	username_2 varchar(50),
    id_quest INT NOT NULL,
	FOREIGN KEY(id_quest) references questoes_respostas(id_questao)
);
