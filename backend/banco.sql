CREATE DATABASE IF NOT EXISTS barbearia;

USE barbearia;

CREATE TABLE IF NOT EXISTS usuario (usuario_id INT NOT NULL AUTO_INCREMENT,
                                    nome VARCHAR(100) NOT NULL,
                                    senha VARCHAR(40) NOT NULL,
                                    email VARCHAR(120) NOT NULL,
                                    administrador INT,
                                    PRIMARY KEY (usuario_id));

INSERT INTO USUARIO (nome, senha, email) VALUES ('Francisco Cleber', 'vrido', 'megafrancisco@gmail.com');
INSERT INTO USUARIO VALUES (2, 'Roberta Guimarães', 'tauba', 'roberta_mineira@hotmail.com', 1);

CREATE TABLE IF NOT EXISTS PRODUTO (produto_id INT NOT NULL AUTO_INCREMENT,
                                    nome VARCHAR(100) NOT NULL,
                                    preco VARCHAR(40) NOT NULL,
                                    imagem VARCHAR(500) NOT NULL,
                                    PRIMARY KEY (produto_id));

INSERT INTO PRODUTO (nome, preco, imagem) VALUES ('Francisco Cleber', 'vrido', 'imagens/exemplo1');
