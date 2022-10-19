# -------------------------------------------------------------------
#                                DB
# -------------------------------------------------------------------


CREATE TABLE usuarios(

    id_usuario INT AUTO_INCREMENT NOT NULL,
	nombre_usuario VARCHAR(30) NOT NULL,
	contrasenia VARCHAR(50) NOT NULL,

	PRIMARY KEY (id_usuario)

);


CREATE TABLE pacientes(

    id_paciente INT AUTO_INCREMENT NOT NULL,
	nombre VARCHAR(20) NOT NULL,
    apellido_paterno VARCHAR(20) NOT NULL,
    apellido_materno VARCHAR(20) NOT NULL,
    num_telefono VARCHAR(20) NOT NULL,
    edad INT NOT NULL,
    sexo ENUM('F', 'M') NOT NULL,
    direccion VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_paciente)    

);


CREATE TABLE partos(

    id_parto INT AUTO_INCREMENT NOT NULL,
    id_madre INT NOT NULL,
    fecha_parto DATE NOT NULL,
    nombre_partera VARCHAR(20) NOT NULL,

    PRIMARY KEY (id_parto),
    FOREIGN KEY (id_madre) REFERENCES pacientes(id_paciente) ON DELETE CASCADE

);


CREATE TABLE analisis(

	id_analisis INT AUTO_INCREMENT NOT NULL,
    id_paciente INT NOT NULL,
    tipo_analisis VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_analisis),
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON DELETE CASCADE

);


# -------------------------------------------------------------------
#                            Inserciones
# -------------------------------------------------------------------


INSERT INTO pacientes(
	nombre,
	apellido_materno,
	apellido_paterno,
	num_telefono,
	edad,
	sexo,
	direccion
	) VALUES(
	'ana',
	'hernandez',
	'pereyra',
	'4949008563',
	30,
	'F',
	'pinos'
);

INSERT INTO usuarios(
	nombre_usuario,
	contrasenia
	) VALUES(
	'toffy',
	MD5('1234'
);

INSERT INTO partos(
	id_madre,
	fecha_parto,
	nombre_partera
	) VALUES(
	1,
	'199-10-09',
	'paula'
);

INSERT INTO analisis(
	id_paciente,
	tipo_analisis
	) VALUES(
	1,
	'glucosa'
);


# -------------------------------------------------------------------
#                             Consultas
# -------------------------------------------------------------------

# SELECT nombre_usuario, contrasenia FROM usuarios WHERE nombre_usuario='toffy' AND contrasenia=MD5('');
