use testingdb;
/*
	INSERCIÓN DE ADMINISTRADORES
*/
INSERT INTO administrador( id, loging, clave,email)
values	(1 ,'admin1','Pass123','admin1@email.com'),
		(2 ,'admin2','Ejemplo','admin2@email.com'),
        (3 ,'admin3','Sample3','admin2@email.com');
        
SELECT * FROM ADMINISTRADOR;
/*
	INSERCIÓN DE PROFESORES
*/
INSERT INTO PROFESOR 	(id, login, 	clave, 		nombre, 	apellidos, email, 					especialista)
			values 		(1 , 'ASibaja', 'Pass123' ,	'Alonso',	'Sibaja',	'Asibaja@email.com',	1),
						(2 , 'DGuevara', 'Pass123' ,'Dylan',	'Guevara',	'Dguevara@email.com',	34),
                        (3 , 'MFuentes', 'Pass123' ,'Maria',	'Fuentes',	'Mfuentes@email.com',	345),
                        (4 , 'DMoreira', 'Pass123' ,'Daniela',	'Moreira',	'DMoreira@email.com',	545);
SELECT * FROM PROFESOR;


/*
	INSERCIÓN DE NIVEL
*/
INSERT INTO NIVEL 		(id, nivel,	curso, aula)
			values 		(1, 'Primero', "A" , "a01"),
						(2, 'Segundo', "B" , "b02"),
						(3, 'Tercero', "C" , "c03");
                        
SELECT * FROM NIVEL;

/*
	INSERCIÓN DE ALUMNOS
*/

INSERT INTO ALUMNO 	(ID, nivel_id , login, 		clave, 		nombre, 	apellidos)
	values			(1 , 1 , 		'Asalas',	'Asalado',	'Adrian',	'Salas' ),
					(2 , 1 , 		'Asalas',	'Asalado1',	'Adrian1',	'Salas1' );

select * from alumno;

/*
	INSERCIÓN DE ASIGNATURAS
*/      
	/*Consulta Profesores existentes*/
	SELECT * FROM PROFESOR;
	/*Consulta Niveles existentes*/
	SELECT * FROM NIVEL;

INSERT INTO ASIGNATURA (id, nivel_id, profesor_id, nombre)
				values	(1, 1, 1, 'Español'),
						(2,2,2, 'Informatica');					
select * from Asignatura;				

/*
	INSERCIÓN DE HORARIO
*/ 
	/*Consulta Asignatura existentes*/
    SELECT * FROM ASIGNATURA;

INSERT INTO HORARIO		( 	ID, asignatura_id, dia, horainicio, horafin)
				values	(	1,	1			,'Miercoles', '9:00','12:00'	);
Select * from Horario;

/*
	INSERCIÓN Falta_asistencia
*/ 
	/*Consulta Alumno existentes*/                    
    select * from alumno;
	/*Consulta Alumno existentes*/                
    select * from asignatura;
INSERT INTO falta_asistencia( id, alumno_id,asignatura_id, fecha, justificada)
values 						(1, 	1, 1, '2022-7-15', 'no justificada'	),
							(2, 	1, 2, '2022-7-15', 'justificada'	);   
select * from falta_asistencia;

/*
	INSERCIÓN asignatura_has_alumno
*/ 
select * from asignatura;
select * from alumno;

insert into asignatura_has_alumno(id, asignatura_id, alumno_id)
values	(1 ,1,1),
		(2 ,2,2),
        (3 ,1,2);
/*
	INSERCIÓN notas
*/     
select * from asignatura_has_alumno;
select * from nota;

insert into nota(id,asignatura_has_alumno_id,trimestre,nota)
values(1,1,1,50),
	(2,1,2,70),
    (3,3,1,100)