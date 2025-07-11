 	

rodar no terminal: mysql -u root -p



create database odaw;
USE odaw;

CREATE TABLE Login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(20),
    senha VARCHAR(50)
);

INSERT INTO Login (usuario, senha)
VALUES
('monique', '123456MHAM'),
('debora',  '12345D');

UPDATE Login
SET senha = 'senhaforte'
WHERE usuario = 'debora';


SELECT * FROM Login;


DELETE FROM Login
WHERE usuario = 'debora';


DROP TABLE Login;

DROP DATABASE odaw;