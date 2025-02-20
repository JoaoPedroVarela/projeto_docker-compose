CREATE DATABASE IF NOT EXISTS bancoJP;
USE bancoJP;

CREATE TABLE IF NOT EXISTS jogos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nota DECIMAL(3, 2) CHECK (nota >= 0 AND nota <= 10), 
    data_lancamento DATE NOT NULL
);

INSERT INTO jogos (nome, nota, data_lancamento) 
VALUES 
('The Legend of Zelda', 9.8, '2017-03-03'),
('God of War', 9.5, '2018-04-20'),
('Cyberpunk 2077', 7.8, '2020-12-10');
