create database imoveis;
use imoveis;
create table usuario(
cpf varchar(14) primary key not null,
email varchar(50) not null,
senha varchar(20) not null,
nome varchar(40) not null,
sobrenome varchar(100) not null,
rg varchar(12) not null,
data_nasci date not null,
sexo varchar(9) not null,
fk_contato varchar(15) not null,
fk_imovel int 
);
create table telefone(
contato varchar(15) not null primary key
);

alter table usuario add foreign key(fk_contato) references telefone (contato);
insert into usuario(cpf,email,senha,nome,sobrenome,rg,data_nasci,sexo,fk_contato) values ("10245784741","pedro@gmail.com","123456789","stivem","sidney","147847578","2002-08-10","masculino","11578945125");

create table imovel(
codigo int auto_increment primary key,
descricao varchar(50) not null,
preco double not null,
foto varchar(20) not null,
fk_endereco char(15)
);
create table endereco_imovel(
cep char(15) primary key not null,
estado char(2) not null,
cidade varchar(30) not null,
rua varchar(30) not null,
numero varchar(3) not null,
bairro varchar(40) not null,
complemeto varchar(40)
);
alter table imovel add foreign key(fk_endereco) references endereco_imovel (cep);
alter table usuario add foreign key(fk_imovel) references imovel(codigo);

create table funcionario(
cpf varchar(14) primary key not null,
email varchar(50) not null,
nome varchar(40) not null,
sobrenome varchar(100) not null,
rg varchar(12) not null,
data_nasci date not null,
sexo varchar(9) not null,
fk_contato varchar(15),
fk_endereco varchar(30)
);
create table endereco_func(
cep char(15) primary key not null,
estado char(2) not null,
cidade varchar(30) not null,
rua varchar(30) not null,
numero varchar(3) not null,
bairro varchar(40) not null,
complemeto varchar(40)
);
create table telefone1(
contato varchar(15) not null primary key
);
alter table funcionario add foreign key(fk_contato) references telefone1 (contato);
alter table funcionario add foreign key(fk_endereco) references endereco_func (cep);

delimiter $$
create procedure contador_func(out quan int)
begin
select count(cpf) into quan
from funcionario;
end $$
delimiter ;

delimiter $$
create procedure contador_imovel(out quan int)
begin
select count(cep) into quan
from imovel;
end $$
delimiter ;

delimiter $$
create procedure contador_usuario(out quan int)
begin
select count(cpf) into quan
from usuario;
end $$
delimiter ;

