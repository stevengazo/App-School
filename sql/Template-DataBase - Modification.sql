CREATE DATABASE TESTINGDB;
USE TESTINGDB;


/*CREACIÓN BASICA DE TABLAS SIN FK*/
CREATE TABLE administrador(
	id INTEGER,
	loging TEXT,
	clave TEXT,
	EMAIL TEXT
);

CREATE TABLE PROFESOR(
	id INTEGER PRIMARY KEY,
	login TEXT,
	clave TEXT,
	nombre TEXT,
	apellidos TEXT,
	email TEXT,
	especialista INTEGER
);

CREATE TABLE Horario (
	id INTEGER PRIMARY KEY,
	asignatura_id integer,
	dia TEXT,
	horaInicio TEXT,
	horaFin text
);

CREATE TABLE asignatura(
	id INTEGER PRIMARY KEY,
	nivel_id INTEGER,
	profesor_id INTEGER,
	nombre TEXT
);
CREATE TABLE falta_asistencia(
	id INTEGER PRIMARY KEY,
	alumno_id INTEGER,
	asignatura_id INTEGER,
	fecha DATE,
	justificada TEXT
);
CREATE TABLE nota(
	id INTEGER PRIMARY KEY,
	/* NO SON NECESARIOS
    asignatura_has_alumno_alumno_id INTEGER,
	asignatura_has_asignatura_id INTEGER,*/
    asignatura_has_alumno_id integer,
	trimestre INTEGER,
	nota DECIMAL
);

CREATE TABLE nivel(
	id INTEGER PRIMARY KEY,
	nivel TEXT,
	curso TEXT,
	AULA TEXT
);

CREATE TABLE ALUMNO(
	id INTEGER PRIMARY KEY,
	nivel_id INTEGER,
	login TEXT,
	clave TEXT,
	nombre TEXT,
	apellidos TEXT    
);

CREATE TABLE  asignatura_has_alumno(
	id INTEGER PRIMARY KEY,
	asignatura_id INTEGER,
	alumno_id integer
    
	/*id_nota INTEGER No es necesario */ 
);


CREATE TABLE Padre(
	id INTEGER primary KEY,
	loging TEXT,
	clave TEXT,
	EMAIL TEXT,
    nombre TEXT,
    apellidos TEXT
);


/*
	CREACIÓN DE RELACIONES 
    SAMPLE
   
    
*/
/* FOREIGN KEYS - ASIGNATURA*/
ALTER TABLE  asignatura ADD FOREIGN KEY Asignatura_FKIndex1 (profesor_id) 	REFERENCES profesor(id);
ALTER TABLE  asignatura ADD FOREIGN KEY Asignatura_FKIndex2 (nivel_id) 		REFERENCES nivel(id);

/* FOREIGN KEYS - HORARIO*/
ALTER TABLE horario ADD foreign key Horario_FKIndex1 (asignatura_id) REFERENCES asignatura(id);

/* FOREIGN KEYS - ASISTENCIA*/
ALTER TABLE falta_asistencia ADD FOREIGN KEY   	(asignatura_id) REFERENCES asignatura(id);
ALTER TABLE falta_asistencia ADD FOREIGN KEY 	(alumno_id) 	REFERENCES alumno(id);

/* FOREIGN KEYS - ALUMNO*/
ALTER TABLE alumno ADD  FOREIGN KEY Alumno_FKIndex1  (nivel_id) REFERENCES nivel(id);

/* FOREIGN KEYS - ASIGNATURA HAS ALUMNO*/
ALTER TABLE asignatura_has_alumno ADD FOREIGN KEY Asignatura_has_alumno_FKIndex1(asignatura_id) REFERENCES asignatura(id);
ALTER TABLE asignatura_has_alumno ADD FOREIGN KEY Asignatura_has_alumno_FKIndex2(alumno_id) 	REFERENCES alumno(id);


/* FOREIGN KEYS - nota*/
/*
	NO SON NECESARIAS
ALTER TABLE NOTA ADD FOREIGN KEY Nota_FKIndex1 (asignatura_has_alumno_alumno_id) 	REFERENCES asignatura_has_alumno (asignatura_id);
ALTER TABLE NOTA ADD FOREIGN KEY Nota_FKIndex2 (asignatura_has_asignatura_id) 		REFERENCES asignatura_has_alumno (alumno_id);*/

ALTER TABLE NOTA ADD FOREIGN KEY Nota_FKIndex1 (asignatura_has_alumno_id) 	REFERENCES asignatura_has_alumno(id);

/* padre-has-alumno */
ALTER TABLE Padre_Has_Alumno ADD FOREIGN KEY (padre_id) REFERENCES padre(id);
ALTER TABLE Padre_Has_Alumno ADD FOREIGN KEY (alumno_id) REFERENCES alumno(id);


