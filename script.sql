CREATE DATABASE proyecto_maiz_db;
USE DATABASE proyecto_maiz_db;
CREATE TABLE seccion (
  nombre VARCHAR(50) NOT NULL,
  PRIMARY KEY(nombre)
);

INSERT INTO seccion ( nombre ) 
  VALUES 
  ( 'Cultura' ),
  ( 'Ciencia' ),
  ( 'Genetica' ),
  ( 'Cultivo' ),
  ( 'Historia' );

--select secciones
SELECT * FROM seccion;
