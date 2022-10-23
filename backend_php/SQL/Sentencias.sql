# -------------------------------------------------------------------
#                                DB
# -------------------------------------------------------------------


CREATE TABLE usuarios(

    id_usuario SERIAL NOT NULL,
	nombre_usuario VARCHAR(30) NOT NULL,
	contrasenia VARCHAR(50) NOT NULL,

	PRIMARY KEY (id_usuario)

);


CREATE TYPE sexo AS ENUM ('M', 'F');
CREATE TABLE pacientes(

    id_paciente SERIAL NOT NULL,
	nombre VARCHAR(20) NOT NULL,
    apellido_paterno VARCHAR(20) NOT NULL,
    apellido_materno VARCHAR(20) NOT NULL,
    num_telefono VARCHAR(20) NOT NULL,
    edad INT NOT NULL,
    sexo sexo,
    direccion VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_paciente)    

);


CREATE TABLE partos(

    id_parto SERIAL NOT NULL,
    id_madre INT NOT NULL,
    fecha_parto DATE NOT NULL,
    nombre_partera VARCHAR(20) NOT NULL,

    PRIMARY KEY (id_parto),
    FOREIGN KEY (id_madre) REFERENCES pacientes(id_paciente) ON DELETE CASCADE

);

ALTER TABLE partos ADD CONSTRAINT madre_habitacion UNIQUE(id_madre);


CREATE TABLE analisis(

	id_analisis SERIAL NOT NULL,
    id_paciente INT NOT NULL,
    tipo_analisis VARCHAR(50) NOT NULL,

    PRIMARY KEY (id_analisis),
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id_paciente) ON DELETE CASCADE

);


CREATE FUNCTION sp_login(IN param_nombre_usuario VARCHAR(30), IN param_contrasenia VARCHAR(50)) RETURNS VARCHAR AS $$
DECLARE
    nom_usu VARCHAR(30);
BEGIN
    SELECT
        nombre_usuario
    INTO
        nom_usu
    FROM
        usuarios
    WHERE
        nombre_usuario=param_nombre_usuario AND contrasenia=MD5(param_contrasenia);
    return nom_usu;
END;
$$ LANGUAGE plpgsql;


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
	MD5('1234')
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
