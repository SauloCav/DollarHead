create database quizGame;

drop database quizGame;

CREATE TABLE users (
    id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nickname VARCHAR(20) NOT NULL
);

CREATE TABLE questoes_respostas (
    id_questao INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pergunta varchar(100) NOT NULL,
    resp_correta varchar(50) NOT NULL,
    resp_a varchar(50) NOT NULL,
	resp_b varchar(50) NOT NULL,
	resp_c varchar(50) NOT NULL,
    indice_dif INT NOT NULL,
    quest_topico varchar(20) NOT NULL,
	valida enum ('v','i') NOT NULL
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

CREATE TABLE stats (
	id_estats INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    n_partidas_jogadas INT NOT NULL,
	premio_total INT NOT NULL,
	n_util_eli_duas_altern INT NOT NULL,
    n_derr_erro INT NOT NULL,
	n_derr_parada INT NOT NULL,
	num_contributions INT NOT NULL,
    user_level VARCHAR(50) NOT NULL,
    id_user_stats INT NOT NULL,
	FOREIGN KEY(id_user_stats) references users(id_user)
);

CREATE TABLE ranking (
    id_ranking INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pontuacao REAL NOT NULL,
    data_pont DATETIME DEFAULT CURRENT_TIMESTAMP,
	id_usuario INT NOT NULL,
	FOREIGN KEY(id_usuario) references users(id_user)
);

select * from users;
select * from questoes_respostas;
select * from denuncia_validacao;
select * from stats;
select * from ranking;

SELECT * FROM stats WHERE id_user_stats = 1;

insert into questoes_respostas values
	(default, 'Em qual local da Ásia o português é língua oficial?', 'Macau', 'Moçambique', 'Filipinas', 'Índia', 3, 'Ciências Humanas', 'i'),
    (default, 'O etanol é produzido através de qual fonte de energia?', 'Biomassa', 'Eólica', 'Solar', 'Geotérmica', 3, 'Ciências da Natureza', 'i'),
    (default, 'Qual tive da NFL detêm a maior torcida em solo americano?', 'Cowboys', 'Bears', 'Patriots', 'Steelers', 3, 'Esportes', 'i'),
    (default, 'Que povo foi o primeiro a utilizar a bússola?', 'chineses', 'romanos', 'mesopotâmicos', 'egípcios', 3, 'Ciências Humanas', 'i'),
    (default, 'Meu avô tem 5 filhos, cada filho tem 3 filhos. Quantos primos eu tenho?', '12', '10', '11', '6', 3, 'Exatas', 'i'),
    (default, 'Quantos ossos temos no nosso corpo?', '206', '126', '300', '200', 3, 'Ciências da Natureza', 'i'),
    (default, 'Quantos andares tem o maior prédio do mundo?', '163', '100', '200', '25', 3, 'Conhecimentos Gerais', 'v'),
    (default, 'Jim Morrison era vocalista de que grupo?', 'The Doors', 'The Police', 'Nirvana', 'Pink Floyd', 3, 'Artes', 'v'),
    (default, 'Quanto mede uma girafa?', 'Entre 4,8 e 5,5 metros', '2 metros', '2,5 metros', 'Entre 5 e 6 metros', 3, 'Conhecimentos Gerais', 'v'),
    (default, '“It is six twenty" ou "twenty past six”. Que horas são em inglês?', '6:20', '2:20', '12:06', '6:02', 3, 'Linguagens', 'v'),
    
    (default, 'De quem é a famosa frase “Penso, logo existo”?', 'Descartes', 'Platão', 'Galileu Galilei', 'Sócrates', 2, 'Ciências Humanas', 'v'),
	(default, 'Quem pintou "Guernica"?', 'Pablo Picasso', 'Paul Cézanne', 'Diego Rivera', 'Tarsila do Amaral', 2, 'Artes', 'i'),
    (default, 'Quantos braços tem um polvo?', 'Oito', 'Seis', 'Sete', 'Dez', 2, 'Conhecimentos Gerais', 'i'),
    (default, 'De que são constituídos os diamantes?', 'Carbono', 'Rênio', 'Bóhrio', 'Ósmio', 2, 'Ciências da Natureza', 'i'),
    (default, 'Quem pintou o teto da capela sistina?', 'Michelangelo', 'Rafael', 'Leonardo da Vinci', 'Donatello', 2, 'Artes', 'v'),
    (default, 'Em que país se localizava Auschwitz, o maior campo de concentração nazi?', 'Polônia', 'Alemanha', 'Áustria', 'Japão', 2, 'Ciências Humanas', 'v'),
    (default, 'Quantos graus são necessários para que dois ângulos sejam complementares?', '90', '45', '360', '180', 2, 'Exatas', 'v'),
    (default, 'Qual a nacionalidade de Che Guevara?', 'Argentina', 'Peruana', 'Panamenha', 'Boliviana', 2, 'Ciências Humanas', 'i'),
    (default, 'Qual a altura da rede de vôlei nos jogos masculino e feminino?', '2,43 m e 2,24 m', '2,5 m e 2,0 m', '1,8 m e 1,5 m', '2,45 m e 2,15 m', 2, 'Esportes', 'v'),
    (default, 'Em que país nasceu o Conde Drácula?', 'Transilvânia', 'Irlanda', 'Escócia', 'Polônia', 2, 'Conhecimentos Gerais', 'i'),
    (default, 'Qual o livro mais vendido no mundo a seguir à Bíblia?', 'Dom Quixote', 'O Senhor dos Anéis', 'O Pequeno Príncipe', 'Ela, a Feiticeira', 2, 'Conhecimentos Gerais',  'v'),
    (default, 'Quantas casas decimais tem o número pi?', 'Infinitas', 'Duas', 'Centenas', 'Vinte', 2, 'Exatas', 'v'),
    (default, 'Atualmente, quantos elementos químicos a tabela periódica possui?', '118', '113', '109', '108', 2, 'Ciências da Natureza', 'i'),
    (default, 'Qual o metal cujo símbolo químico é o Au?', 'Ouro', 'Cobre', 'Mercúrio', 'Manganês', 2, 'Ciências da Natureza', 'v'),
    (default, 'Qual a língua falada em Israel?', 'Hebraico', 'Israelense', 'Inglês', 'Latin', 2, 'Linguagens', 'v'),
    
    (default, 'O que a palavra legend significa em português?', 'Lenda', 'Legenda', 'Conto', 'História', 1, 'Linguagens', 'v'),
    (default, 'Qual o monumento famoso pela sua inclinação', 'Torre de Pisa', 'Cristo Redentor', 'Esfinge', 'Torre Eiffel', 1, 'Conhecimentos Gerais', 'v'),
    (default, 'Quais são os cromossomos que determinam o sexo masculino?', 'Os Y', 'Os W', 'Os X', 'Os V', 1, 'Ciências da Natureza', 'v'),
    (default, 'Quem pintou Mona Lisa?', 'Leonardo da Vinci', 'Salvador Dalí', 'Van Gogh', 'Pablo Picasso', 1, 'Artes', 'v'),
    (default, 'Qual o nome popular do cloreto de sódio?', 'Sal de cozinha', 'Fermento', 'Papel', 'Vinagre', 1, 'Ciências da Natureza', 'v'),
    (default, 'Depois do futebol, qual o esporte mais popular no Brasil?', 'Vôlei', 'Golfe', 'Esgrima', 'Esqui', 1, 'Esportes', 'v'),
    (default, 'Quanto é o dobro 1500?', '3000', '2000', '15000', '0', 1, 'Exatas', 'v'), 
    (default, 'Em que país foi construído o Muro de Berlim?', 'Alemanha', 'Brasil', 'Uruguai', 'Polônia', 1, 'Ciências Humanas', 'v'), 
    (default, 'Qual o maior planeta do sistema solar?', 'Júpiter', 'Terra', 'Saturno', 'Marte', 1, 'Ciências Humanas', 'v'),
    (default, 'Qual a unidade que mede a intensidade do som?', 'Decibel', 'Frequência', 'Hertz', 'Compasso', 1, 'Ciências da Natureza', 'v');
    
    
insert into denuncia_validacao values
	(default, 0, 0, NULL, NULL, 1),
    (default, 0, 0, NULL, NULL, 2),
    (default, 0, 0, NULL, NULL, 3),
    (default, 0, 0, NULL, NULL, 4),
    (default, 0, 0, NULL, NULL, 5),
    (default, 0, 0, NULL, NULL, 6),
    (default, 0, 0, NULL, NULL, 7),
    (default, 0, 0, NULL, NULL, 8),
    (default, 0, 0, NULL, NULL, 9),
    (default, 0, 0, NULL, NULL, 10),
    (default, 0, 0, NULL, NULL, 11),
    (default, 0, 0, NULL, NULL, 12),
    (default, 0, 0, NULL, NULL, 13),
    (default, 0, 0, NULL, NULL, 4),
    (default, 0, 0, NULL, NULL, 15),
    (default, 0, 0, NULL, NULL, 16),
    (default, 0, 0, NULL, NULL, 17),
    (default, 0, 0, NULL, NULL, 18),
    (default, 0, 0, NULL, NULL, 19),
    (default, 0, 0, NULL, NULL, 20),
    (default, 0, 0, NULL, NULL, 21),
    (default, 0, 0, NULL, NULL, 22),
    (default, 0, 0, NULL, NULL, 23),
    (default, 0, 0, NULL, NULL, 24),
    (default, 0, 0, NULL, NULL, 25),
    (default, 0, 0, NULL, NULL, 26),
    (default, 0, 0, NULL, NULL, 27),
    (default, 0, 0, NULL, NULL, 28),
    (default, 0, 0, NULL, NULL, 29),
    (default, 0, 0, NULL, NULL, 30),
    (default, 0, 0, NULL, NULL, 31),
    (default, 0, 0, NULL, NULL, 32),
    (default, 0, 0, NULL, NULL, 33),
    (default, 0, 0, NULL, NULL, 34),
    (default, 0, 0, NULL, NULL, 35);


truncate table ranking;
truncate table stats;
truncate table denuncia_validacao;
truncate table questoes_respostas;
truncate table users;

drop table ranking; 
drop table stats;
drop table denuncia_validacao;
drop table questoes_respostas;
drop table users;

delete from users where id_user = 6;