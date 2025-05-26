create database parcial01_mrml 

-- ===============================================
CREATE TABLE actividades (
    act_id SERIAL PRIMARY KEY,
    act_nombre VARCHAR(255) NOT NULL,
    act_estado VARCHAR(20) DEFAULT 'ACTIVO',
    act_fecha DATETIME YEAR TO SECOND,
    situacion SMALLINT DEFAULT 1
);
