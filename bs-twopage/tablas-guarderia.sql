cl scr

PROM **************************************************
DROP INDEX ind_01_tel_tut;
DROP INDEX ind_02_nin_pag;
DROP INDEX ind_03_res_nin;
DROP INDEX ind_04_res_tut;
DROP INDEX ind_05_ale_nin;
DROP INDEX ind_06_ale_ing;
DROP INDEX ind_07_rec_pla;
DROP INDEX ind_08_rec_ing;
DROP INDEX ind_09_men_men;
DROP INDEX ind_10_men_pla;
DROP INDEX ind_11_die_nin;
DROP INDEX ind_12_die_men;

DROP SEQUENCE sec_menus;
DROP SEQUENCE sec_platillos;
DROP SEQUENCE sec_ingredientes;
DROP SEQUENCE sec_ninos;
DROP SEQUENCE sec_tutores;

-- Forma legal de dropear tablas (inversa a la creacion)
DROP TABLE dietas;
DROP TABLE menuplatillos;
DROP TABLE menus;
DROP TABLE recetas;
DROP TABLE platillos;
DROP TABLE alergias;
DROP TABLE ingredientes;
DROP TABLE responsables;
DROP TABLE ninos;
DROP TABLE telefonos;
DROP TABLE tutores;

PROM **************************************************


-- ORDEN de construccion de tablas
-- (1)
CREATE TABLE tutores (
	idtut		NUMBER(5) NOT NULL,
	curp 		VARCHAR2(18) NOT NULL,-- help,860706,h,df,rpb,05
	ine			VARCHAR2(18) NOT NULL,-- hrlp,pb,860706,09h000
	nombres		VARCHAR2(30) NOT NULL,-- 
	apaterno	VARCHAR2(30) NOT NULL,
	amaterno	VARCHAR2(30),
	calle		VARCHAR2(50) NOT NULL,-- cda. miramontes, parque ecologico No.762
	delegacion	VARCHAR2(30) NOT NULL,-- cuajimalpa de morelos, magdalena contreras
	colonia		VARCHAR2(30) NOT NULL,--
	cpostal		NUMBER(5) NOT NULL,-- 14400
	rfc			VARCHAR2(13), -- -- help,860706,XXX
	email		VARCHAR2(35),
	banco		VARCHAR2(25),
	cuenta		NUMBER(16),
	CONSTRAINT cpk_tut_idt PRIMARY KEY (idtut)
);

CREATE SEQUENCE sec_tutores
START WITH 1000
INCREMENT BY 1
MAXVALUE 99999
NOCYCLE;

-- (2)
CREATE TABLE telefonos (
	telefono 	NUMBER(13) NOT NULL,--04455,xxxx,yyyy
	tipo		VARCHAR2(7) NOT NULL,-- casa, oficina, celular
	tutorid		NUMBER(5) NOT NULL,
	CONSTRAINT cpk_tel_tel PRIMARY KEY (telefono),
	CONSTRAINT cfk_tel_tut FOREIGN KEY (tutorid) REFERENCES tutores(idtut) on delete cascade
);
CREATE INDEX ind_01_tel_tut ON telefonos(tutorid);

-- (3)
CREATE TABLE ninos (
	matricula	NUMBER(5) NOT NULL,
	nombres		VARCHAR2(30) NOT NULL,
	apaterno	VARCHAR2(30) NOT NULL,
	amaterno	VARCHAR2(30),
	fnacimiento	DATE NOT NULL,
	fingreso	DATE NOT NULL,
	fegreso		DATE,
	colegiatura	NUMBER NOT NULL,
	pagacuotaid	NUMBER(5), -- el tutor que paga la colegiatura
	CONSTRAINT cpk_nin_mat PRIMARY KEY (matricula),
	CONSTRAINT cfk_nin_pag FOREIGN KEY (pagacuotaid) REFERENCES tutores(idtut)
);
CREATE INDEX ind_02_nin_pag ON ninos(pagacuotaid);

CREATE SEQUENCE sec_ninos
START WITH 2000
INCREMENT BY 1
MAXVALUE 99999
NOCYCLE;

--(4)
CREATE TABLE responsables (
	ninoid		NUMBER (5) NOT NULL,
	tutorid		NUMBER (5) NOT NULL,
	parentesco	VARCHAR2(10) NOT NULL,-- padre, madre, hermano, etc.
	CONSTRAINT cpk_res_nintut PRIMARY KEY (ninoid,tutorid),
	CONSTRAINT cfk_res_nin FOREIGN KEY (ninoid) REFERENCES ninos(matricula) on delete cascade,
	CONSTRAINT cfk_res_tut FOREIGN KEY (tutorid) REFERENCES tutores(idtut) on delete cascade
);
CREATE INDEX ind_03_res_nin ON responsables(ninoid);
CREATE INDEX ind_04_res_tut ON responsables(tutorid);

--(5)
CREATE TABLE ingredientes (
	idingre	NUMBER(5) NOT NULL,
	nombre 	VARCHAR2(20) NOT NULL,
	CONSTRAINT cpk_ing_idi PRIMARY KEY (idingre)
);

CREATE SEQUENCE sec_ingredientes
START WITH 3000
INCREMENT BY 1
MAXVALUE 99999
NOCYCLE;

--(6)
CREATE TABLE alergias (
	ninoid			NUMBER (5) NOT NULL,
	ingredienteid	NUMBER (5) NOT NULL,
	medicamento		VARCHAR2(30),
	CONSTRAINT cpk_ale_nining PRIMARY KEY (ninoid,ingredienteid),
	CONSTRAINT cfk_ale_nin FOREIGN KEY (ninoid) REFERENCES ninos(matricula) on delete cascade,
	CONSTRAINT cfk_ale_ing FOREIGN KEY (ingredienteid) REFERENCES ingredientes(idingre) on delete cascade
);
CREATE INDEX ind_05_ale_nin ON alergias(ninoid);
CREATE INDEX ind_06_ale_ing ON alergias(ingredienteid);

--(7)
CREATE TABLE platillos (
	idplat 	NUMBER(5) NOT NULL,
	nombre 	VARCHAR2(30) NOT NULL,
	CONSTRAINT cpk_pla_idp PRIMARY KEY (idplat)
);

CREATE SEQUENCE sec_platillos
START WITH 4000
INCREMENT BY 1
MAXVALUE 99999
NOCYCLE;

--(8)
CREATE TABLE recetas (
	platilloid		NUMBER (5) NOT NULL,
	ingredienteid	NUMBER (5) NOT NULL, -- !! anexar porcion (cantidad) del ingrediente
	CONSTRAINT cpk_rec_plaing PRIMARY KEY (platilloid,ingredienteid),
	CONSTRAINT cfk_rec_pla FOREIGN KEY (platilloid) REFERENCES platillos(idplat) on delete cascade,
	CONSTRAINT cfk_rec_ing FOREIGN KEY (ingredienteid) REFERENCES ingredientes(idingre) on delete cascade
);
CREATE INDEX ind_07_rec_pla ON recetas(platilloid);
CREATE INDEX ind_08_rec_ing ON recetas(ingredienteid);

--(9)
CREATE TABLE menus (
	idmenu		NUMBER(5) NOT NULL,
	fcreacion	DATE NOT NULL,
	precio		NUMBER NOT NULL,
	tipo		VARCHAR2(8),-- Desatuno / Comida / Merienda
	CONSTRAINT cpk_men_idm PRIMARY KEY (idmenu)
);

CREATE SEQUENCE sec_menus
START WITH 5000
INCREMENT BY 1
MAXVALUE 99999
NOCYCLE;

--(10)
CREATE TABLE menuplatillos (
	menuid		NUMBER(5) NOT NULL,
	platilloid 	NUMBER(5) NOT NULL,
	CONSTRAINT cpk_men_menpla PRIMARY KEY (menuid,platilloid),
	CONSTRAINT cfk_men_men FOREIGN KEY (menuid) REFERENCES menus(idmenu) on delete cascade,
	CONSTRAINT cfk_men_pla FOREIGN KEY (platilloid) REFERENCES platillos(idplat) on delete cascade
);
CREATE INDEX ind_09_men_men ON menuplatillos(menuid);
CREATE INDEX ind_10_men_pla ON menuplatillos(platilloid);

--(11)
CREATE TABLE dietas (
	ninoid		NUMBER(5) NOT NULL,
	menuid	 	NUMBER(5) NOT NULL,
	fecha 		DATE NOT NULL, -- Guardar fecha y HORA
	CONSTRAINT cpk_die_ninmen PRIMARY KEY (ninoid,menuid),
	CONSTRAINT cfk_die_nin FOREIGN KEY (ninoid) REFERENCES ninos(matricula) on delete cascade, 
	CONSTRAINT cfk_die_men FOREIGN KEY (menuid) REFERENCES menus(idmenu) on delete cascade
);
CREATE INDEX ind_11_die_nin ON dietas(ninoid);
CREATE INDEX ind_12_die_men ON dietas(menuid);

-------------------------------------------------------------------------------------
-- INSERCIONES --
--customers_seq.nextval
INSERT INTO tutores VALUES(sec_tutores.nextval,'AEPG910706MDFNRB09','234123100987PO9827','Jesus','Arriaga','Mendez','zapote','Iztapalapa','San Miguel',49500,'ES873DPODF43D','mendezArri@gmail.com','Banamex',1002345678902345);
INSERT INTO tutores VALUES(sec_tutores.nextval,'ERPU345634MDFURB08','87PO98272341231009','Marcela','Gomez','Hernan','salvador','Iztapalapa','Santa Cruz',69500,'D43APODES873F','mushasha@yahoo.com.mx','BBVA Bancomer',1012347845956023);
INSERT INTO tutores VALUES(sec_tutores.nextval,'ISOE096421MDFTVE09','2728700998O341P312','Diego Omar','Escamilla','Rueda','28','Iztapalapa','San Felipe',56788,'DR76POITS832B','perrito123@hotmail.com','Banorte',1020872334550128);
INSERT INTO tutores VALUES(sec_tutores.nextval,'ISOE096421MDFTVE09','2728700998O341P312','Sofia','Millan','Perez','cerrada de minas','Tlahuac','San Lorenzo',12399,'SLO67321S832A','sofia_millan1@hotmail.com','HSBC',1035109876328765);
INSERT INTO tutores VALUES(sec_tutores.nextval,'KSHD123478HDKSLS92','DASJ21JDJ219892722','Dante','Perez','Ibarra','talcocuyo No4','tlalpan','San Andres',14400,null,null,null,null);

INSERT INTO telefonos VALUES ( 11223344, 'casa', 1000);
INSERT INTO telefonos VALUES ( 11112222, 'casa', 1001);
INSERT INTO telefonos VALUES ( 12123333, 'oficina', 1002);
INSERT INTO telefonos VALUES ( 0445599998888, 'celular', 1003);
INSERT INTO telefonos VALUES ( 5566667777, 'celular', 1004);

INSERT INTO ninos VALUES(sec_ninos.nextval,'Maria','Arriaga','Hernan','10-01-2013','24-11-2016','24-11-2017',1500,1000);
INSERT INTO ninos VALUES(sec_ninos.nextval,'Hugo','Escamilla','Ramones','15-10-2012','21-05-2016','21-12-2017',2000,1002);	
INSERT INTO ninos VALUES(sec_ninos.nextval,'Carlos','Lopez','Millan','01-10-2015','10-06-2016',null,1500,1003);
INSERT INTO ninos VALUES(sec_ninos.nextval,'Luis','Doriga','Mongoy','11-10-2014','01-05-2016',null,1200,1000);
INSERT INTO ninos VALUES(sec_ninos.nextval,'Ramon','Estrada','Perez','05-06-2013','10-8-2016',null,1000,1002);

INSERT INTO responsables VALUES(2000,1000,'Padre');
INSERT INTO responsables VALUES(2000,1001,'Madre');
INSERT INTO responsables VALUES(2001,1002,'Padre');
INSERT INTO responsables VALUES(2002,1003,'Madre');
INSERT INTO responsables VALUES(2003,1001,'Familiar');
INSERT INTO responsables VALUES(2004,1003,'Familiar');

INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'azucar');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'crema');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'fresas');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'chocolate');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'pollo');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'carne de res');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'pescado');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'arroz');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'tomate');
INSERT INTO ingredientes VALUES(sec_ingredientes.nextval, 'ajo');

INSERT INTO platillos VALUES (sec_platillos.nextval, 'fresas con crema');
INSERT INTO platillos VALUES (sec_platillos.nextval, 'pastel de chocolate');
INSERT INTO platillos VALUES (sec_platillos.nextval, 'pollo con arroz');
INSERT INTO platillos VALUES (sec_platillos.nextval, 'res en salsa toja');
INSERT INTO platillos VALUES (sec_platillos.nextval, 'pescado asado');

INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 21, 'Desayuno');
INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 25, 'Comida');
INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 22, 'Cena');
INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 33, 'Desayuno');
INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 31, 'Comida');
INSERT INTO menus VALUES (sec_menus.nextval, sysdate, 28, 'Cena');

INSERT INTO recetas VALUES (4000,3000);
INSERT INTO recetas VALUES (4000,3001);
INSERT INTO recetas VALUES (4000,3002);
INSERT INTO recetas VALUES (4001,3003);
INSERT INTO recetas VALUES (4001,3004);
INSERT INTO recetas VALUES (4002,3004);

INSERT INTO menuplatillos VALUES (5000,4000);
INSERT INTO menuplatillos VALUES (5001,4001);
INSERT INTO menuplatillos VALUES (5002,4002);

INSERT INTO dietas VALUES (2000,5000,sysdate);
INSERT INTO dietas VALUES (2001,5001,sysdate);
INSERT INTO dietas VALUES (2002,5002,sysdate);

INSERT INTO alergias VALUES (2000,3000,null);
INSERT INTO alergias VALUES (2001,3001,null);
INSERT INTO alergias VALUES (2002,3002,null);



commit;














