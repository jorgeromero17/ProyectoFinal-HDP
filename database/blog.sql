DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog;

USE blog;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id int(11) NOT NULL AUTO_INCREMENT,
    nombre varchar(50),
    apellido varchar(50),
    email varchar(150) UNIQUE,
    usuario varchar(50),
    contra varchar(200),
    tipo int(1),
    PRIMARY KEY (id)
);

INSERT INTO usuarios (nombre, apellido, email, usuario, contra, tipo)
            VALUES   ('Super', 'Usuario','','admin','admin','1');