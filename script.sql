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
  ( 'Miscelanea' ),
  ( 'Historia' );

CREATE TABLE usuario (
  username VARCHAR(50) NOT NULL,
  password VARCHAR(64) NOT NULL,
  nombre VARCHAR(255) UNIQUE,
  tipo ENUM('Admin', 'Autor') NOT NULL,

  PRIMARY KEY(username)
);

INSERT INTO usuario ( username, password, nombre, tipo ) 
  VALUES 
  ( 'admin01', '0876dfca6d6fedf99b2ab87b6e2fed4bd4051ede78a8a9135b500b2e94d99b88', null, 'Admin'),
  ( 'fernanrod', '918eb1206bd94f28f8ae296c9424b8da1171d18151a6c0ac6dd554f82ce94766', 'Fernando Rodríguez', 'Autor'),
  ( 'anaciel', '1d77f50c13bc52ca185648c4f1037740c07bef709e10d33f2abc6ae1495b5fc6', 'Ana Massielle', 'Autor');

CREATE TABLE articulo (
  titulo VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  seccion VARCHAR(50) NOT NULL,
  fecha TIMESTAMP NOT NULL,
  autor VARCHAR(255) NOT NULL,
  imagen VARCHAR(255),
  contenido TEXT NOT NULL,

  PRIMARY KEY(titulo),
  FOREIGN KEY(autor) REFERENCES usuario(username),
  FOREIGN KEY(seccion) REFERENCES seccion(nombre)
);

INSERT INTO articulo (
  titulo, slug, seccion, fecha, autor, imagen, contenido
) VALUES 
  ( 'Primer Articulo!', 'primer-articulo', 'Miscelanea', CURRENT_TIMESTAMP(), 'fernanrod', null, 'Este es el primer articulo escrito para el blog. Esperen mas de nuestros autores!' ),
  ( 'Sobre uxaq-ixim', 'sobre-uxaq-ixim', 'Miscelanea', CURRENT_TIMESTAMP(), 'anaciel', 'sobre-uxaq-ixim.png', 'El blog uxaq ixim (Pagina del Maiz en kiche), es un blog dedicado a publicar y compartir informacion relacionada al maiz' ),
  ( 'Un brevisimo resumen de la historia del maiz', 'brevisima-historia-maiz', 'Historia', CURRENT_TIMESTAMP(), 'fernanrod', null, 'El maiz es una planta originaria de Mesoamerica y en la actualidad es uno de los 3 cultivos basicos para consumo humano.' ),
  ( 'Sobre el maiz y los mayas', 'sobre-maiz-mayas', 'Cultura', CURRENT_TIMESTAMP(), 'fernanrod', null, 'El maiz es un cultivo base para la alimentacion del pueblo maya hasta la actualidad, sobre este se han construido la religion y cultura maya.' ),
  ( 'El maiz, el trigo y el arroz', 'maiz-trigo-arroz', 'Ciencia', CURRENT_TIMESTAMP(), 'anaciel', null, 'Los 3 granos basicos para consumo humano son el maiz, el trigo y el arroz, el primero originario de Mesoamerica, el segundo de Eurasia y el tercero de Asia.' ),
  ( 'Sobre el cultivo del Maiz', 'sobre-cultivo-maiz', 'Cultivo', CURRENT_TIMESTAMP(), 'anaciel', null, 'Para cultivar el maiz de una manera efectiva es necesario tomar en cuenta una variedad de factores como el clima y en especial la cantidad de humedad ya que esta determina la cantidad de maiz que es optimo plantar por cada hectarea.' );

SELECT * FROM articulo ORDER BY fecha DESC LIMIT 10;

--select secciones
SELECT * FROM seccion;
