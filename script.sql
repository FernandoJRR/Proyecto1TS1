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

CREATE TABLE usuario (
  username VARCHAR(50) NOT NULL,
  pass VARCHAR(64) NOT NULL,
  nombre VARCHAR(255) UNIQUE,
  tipo ENUM('Admin', 'Autor') NOT NULL,

  PRIMARY KEY(username)
);

INSERT INTO usuario ( username, password, nombre, tipo ) 
  VALUES 
  ( 'admin01', '0876dfca6d6fedf99b2ab87b6e2fed4bd4051ede78a8a9135b500b2e94d99b88', null, 'Admin'),
  ( 'fernanrod', '918eb1206bd94f28f8ae296c9424b8da1171d18151a6c0ac6dd554f82ce94766', 'Fernando Rodríguez', 'Autor'),
  ( 'anaciel', '1d77f50c13bc52ca185648c4f1037740c07bef709e10d33f2abc6ae1495b5fc6', 'Ana Massielle', 'Autor');

--select secciones
SELECT * FROM seccion;
