CREATE DATABASE ensueno;
USE ensueno;
CREATE TABLE Usuario(
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
	nombreUsuario VARCHAR (50) NOT NULL UNIQUE,
    apellidoUsuario  VARCHAR (50) NOT NULL,
    correo  VARCHAR (50) NOT NULL UNIQUE,
    clave VARCHAR (50) NOT NULL,
    rol VARCHAR (20) NOT NULL
);

CREATE TABLE Banco(
    id_banco INT PRIMARY KEY AUTO_INCREMENT,
    nombre_banco VARCHAR (50) NOT NULL UNIQUE
);
CREATE TABLE Saldo(
    id_saldo INT PRIMARY KEY AUTO_INCREMENT,
	id_banco INT NOT NULL,
    fecha DATE NOT NULL,
    cantidad FLOAT NOT NULL
);
CREATE TABLE Transaccion(
    id_transaccion INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
	id_banco INT NOT NULL,
    id_saldo INT NOT NULL,
    tipo_transaccion VARCHAR (20) NOT NULL,
    valor_transaccion FLOAT NOT NULL,
    fecha DATE NOT NULL
);
CREATE TABLE Novedad(
    id_novedad INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT NOT NULL,
	fecha DATE NOT NULL,
    descripcion VARCHAR (250) NOT NULL
);


ALTER TABLE Saldo ADD CONSTRAINT Saldo_Banco FOREIGN KEY (id_banco) REFERENCES Banco (id_banco);
ALTER TABLE Transaccion ADD CONSTRAINT Transaccion_Usuario FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario);
ALTER TABLE Transaccion ADD CONSTRAINT Transaccion_Banco FOREIGN KEY (id_banco) REFERENCES Banco (id_banco);
ALTER TABLE Transaccion ADD CONSTRAINT Transaccion_Saldo FOREIGN KEY (id_saldo) REFERENCES Saldo (id_saldo);
ALTER TABLE Novedad ADD CONSTRAINT Novedad_Usuario FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario);


-- VISTAS GENERALES
CREATE VIEW View_Usua AS SELECT nombreUsuario, apellidoUsuario, rol FROM Usuario;
CREATE VIEW View_Trans AS SELECT id_transaccion, id_banco, tipo_transaccion, valor_transaccion, fecha FROM Transaccion;


-- PROCEDIMIENTOS DE USUARIOS
delimiter $
create procedure pa_consultarusuario()
BEGIN
SELECT * FROM Usuario;
end $

create procedure pa_consultarusuarioporid (
	in pid_usuario INTEGER)
BEGIN
SELECT * FROM Usuario WHERE id_usuario = pid_usuario;
end $

create procedure pa_insertarusuario (
	in pnombreUsuario VARCHAR (50),
    in papellidoUsuario  VARCHAR (50),
    in pcorreo  VARCHAR (50),
    in pclave VARCHAR (50),
    in prol VARCHAR (20))
BEGIN
INSERT INTO Usuario (nombreUsuario, apellidoUsuario, correo, clave, rol) VALUES (pnombreUsuario, papellidoUsuario, pcorreo, pclave, prol);
end $

create procedure pa_actualizarusuario (
	in pid_usuario INTEGER,
    in pnombreUsuario VARCHAR (50),
    in papellidoUsuario  VARCHAR (50),
    in pcorreo  VARCHAR (50),
    in pclave VARCHAR (50),
    in prol VARCHAR (20))
BEGIN
UPDATE Usuario
SET nombreUsuario = pnombreUsuario,
    apellidoUsuario = papellidoUsuario,
    correo = pcorreo,
    clave = pclave,
    rol =prol
WHERE id_usuario = pid_usuario ;
end $

create procedure pa_eliminarusuario (in pid_usuario INTEGER)
BEGIN
DELETE FROM Usuario WHERE id_usuario = pid_usuario;
end $

-- PROCEDIMIENTOS DE BANCOS
create procedure pa_consultarbanco()
BEGIN
SELECT * FROM Banco;
end $

create procedure pa_consultarbancoporid (
	in pid_banco INTEGER)
BEGIN
SELECT * FROM Banco WHERE id_banco = pid_banco;
end $

create procedure pa_insertarbanco (
	in pnombre_banco VARCHAR (50))
BEGIN
INSERT INTO Banco (nombre_banco) VALUES (pnombre_banco);
end $

create procedure pa_actualizarbanco (
	in pid_banco INTEGER,
    in pnombre_banco VARCHAR (50))
BEGIN
UPDATE Banco 
SET nombre_banco = pnombre_banco
WHERE id_banco = pid_banco;
end $

create procedure pa_eliminarbanco (in pid_banco INTEGER)
BEGIN
DELETE FROM Banco WHERE id_banco = pid_banco;
end $

-- PROCEDIMIENTOS DE SALDOS
create procedure pa_consultarsaldo()
BEGIN
SELECT * FROM Saldo;
end $

create procedure pa_consultarsaldoporid (
	in pid_saldo INTEGER)
BEGIN
SELECT * FROM Saldo WHERE id_saldo = pid_saldo;
end $

create procedure pa_insertarsaldo (
	in pid_banco INT,
    in pfecha DATE,
    in pcantidad FLOAT)
BEGIN
INSERT INTO Saldo (id_banco, fecha, cantidad) VALUES (pid_banco, pfecha, pcantidad);
end $

create procedure pa_actualizarsaldo (
	in pid_saldo INTEGER,
    in pfecha DATE,
    in pcantidad FLOAT)
BEGIN
UPDATE Saldo 
SET fecha = pfecha,
	cantidad = pcantidad
WHERE id_saldo = pid_saldo;
end $

-- PROCEDIMIENTOS DE TRANSACCIONES
create procedure pa_consultartransaccion()
BEGIN
SELECT * FROM Transaccion;
end $

create procedure pa_consultartransaccionporid (
	in pid_transaccion INTEGER)
BEGIN
SELECT * FROM Transaccion WHERE id_transaccion = pid_transaccion;
end $

create procedure pa_insertartransaccion (
	in pid_usuario INT,
	in pid_banco INT,
    in pid_saldo INT,
    in ptipo_transaccion VARCHAR (20),
    in pvalor_transaccion FLOAT,
    in pfecha DATE)
BEGIN
INSERT INTO Transaccion (id_usuario, id_banco, id_saldo, tipo_transaccion, valor_transaccion, fecha) VALUES (pid_usuario, pid_banco, pid_saldo, ptipo_transaccion, pvalor_transaccion, pfecha);
end $

-- PROCEDIMIENTOS DE NOVEDADES
create procedure pa_consultarnovedad()
BEGIN
SELECT * FROM Novedad;
end $

create procedure pa_consultarnovedadporid (
	in pid_novedad INTEGER)
BEGIN
SELECT * FROM Novedad WHERE id_novedad = pid_novedad;
end $

create procedure pa_insertarnovedad (
	in pid_usuario INT,
	in pfecha DATE,
    in pdescripcion VARCHAR (250))
BEGIN
INSERT INTO Novedad (id_usuario, fecha, descripcion) VALUES (pid_usuario, pfecha, pdescripcion);
end $

create procedure pa_eliminarnovedad (in pid_novedad INTEGER)
BEGIN
DELETE FROM Novedad WHERE id_novedad = pid_novedad;
end $
delimiter ;


-- TRIGGER USUARIO
delimiter $
create table DatosAnterioresUsu (id_usuario INT, nombreUsuario VARCHAR(50), apellidoUsuario  VARCHAR(50), correo VARCHAR(50), clave VARCHAR(50), rol VARCHAR (20))$
create trigger triggerUsua_Act before update on Usuario for each row
begin
insert into DatosAnterioresUsu values (old.id_usuario, old.nombreUsuario, old.apellidoUsuario, old.correo, old.clave, old.rol);
end$

-- TRIGGER BANCO
create table DatosAnterioresBanco (id_banco INT, nombre_banco VARCHAR(50))$
create trigger triggerBanco_Act before update on Banco for each row
begin
insert into DatosAnterioresBanco values (old.id_banco, old.nombre_banco);
end$

-- TRIGGER SALDO
create table DatosAnterioresSaldo (id_saldo INT, id_banco INT, fecha DATE, cantidad FLOAT)$
create trigger triggerSaldo_Act before update on Saldo for each row
begin
insert into DatosAnterioresSaldo values (old.id_saldo, old.id_banco, old.fecha, old.cantidad);
end$
delimiter ;