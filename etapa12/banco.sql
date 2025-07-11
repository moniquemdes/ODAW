
create database banco;
use banco;

create table banco (
	id int auto_increment primary key,
    nome varchar(100),
    email varchar(100),
    telefone varchar(20),
    nascimento date,
    usuario varchar(50),
    senha varchar(255)
)