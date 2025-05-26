create database parcial01_mrml 

-- ===============================================
CREATE TABLE actividades (
    act_id SERIAL PRIMARY KEY,
    act_nombre VARCHAR(255) NOT NULL,
    act_estado VARCHAR(20) DEFAULT 'ACTIVO',
    act_fecha DATETIME YEAR TO SECOND,
    situacion SMALLINT DEFAULT 1
);


create table registro (
    reg_id SERIAL PRIMARY KEY,
    act_id INT not null, //Esta es la llave foranea de actividades
    reg_fecha DATETIME YEAR TO SECOND,
    reg_hora TIME,
    estado_asistencia varchar (250) not null,
    situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (act_id) REFERENCES actividades(act_id)
);