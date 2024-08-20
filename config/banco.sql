create database formas;
use formas;

create table Quadrado (
	id_quad int auto_increment primary key,
    id_un int,
    lado int,
    cor varchar(250),
    foreign key(id_un) references Unidade(id_un));

create table Unidade (
	id_un int auto_increment primary key,
    unidade varchar(3)
    );
    commit;