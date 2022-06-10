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
	difficultyIndex INT NOT NULL,
	questionTopic varchar(20) NOT NULL,
	validation enum ('v','i') NOT NULL
);

CREATE TABLE DenounceAndValidation (
	idDenounceValidation INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	numDenounce INT NOT NULL,
	numValidation INT NOT NULL,
	username01 varchar(50),
	username02 varchar(50),
	idQuestionDenounceValidation INT NOT NULL,
	FOREIGN KEY(idQuestionDenounceValidation) references Questions(idQuestion)
);
