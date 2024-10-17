CREATE TABLE equipos (
  id tinyint NOT NULL PRIMARY KEY,
  nombre_equipo varchar,
  escudo varchar
);


CREATE TABLE noticias (
  id bigint NOT NULL PRIMARY KEY,
  titulo varchar,
  img_noticia varchar,
  descripcion varchar
);


CREATE TABLE productos (
  id tinyint NOT NULL PRIMARY KEY,
  img_producto varchar,
  nombre_producto varchar,
  descripcion varchar
);


CREATE TABLE tabla_posiciones (
  id tinyint NOT NULL PRIMARY KEY,
  id_equipo tinyint NOT NULL,
  partidos_jugados tinyint,
  partidos_ganados tinyint,
  partidos_empatados tinyint,
  partidos_perdidos tinyint,
  goles_favor tinyint,
  goles_contra tinyint,
  goles_diferencia tinyint,
  puntos tinyint
);


ALTER TABLE equipos ADD CONSTRAINT equipos_id_fk FOREIGN KEY (id) REFERENCES tabla_posiciones (id_equipo);

