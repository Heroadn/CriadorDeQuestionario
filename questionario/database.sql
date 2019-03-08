create schema quiz;
use quiz;

create table questionario(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(30) NOT NULL,
    total INTEGER
);
create table pergunta(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    texto VARCHAR(100) NOT NULL,
    id_questionario INTEGER NOT NULL,
    FOREIGN KEY (id_questionario) references questionario(id)
);

create table resposta(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    texto VARCHAR(100) NOT NULL,
    votos INTEGER DEFAULT 0,
    id_pergunta INTEGER,
    FOREIGN KEY (id_pergunta) references pergunta(id)
);


