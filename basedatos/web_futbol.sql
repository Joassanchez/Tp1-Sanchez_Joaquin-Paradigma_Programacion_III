CREATE DATABASE IF NOT EXISTS web_futbol;
USE web_futbol;

-- Crear tabla para las noticias
CREATE TABLE IF NOT EXISTS noticias (
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  img VARCHAR(255),
  descripcion TEXT,
  fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP,
  estatus TINYINT(1) DEFAULT 1
);


-- Crear tabla para los equipos, con la columna img incluida
CREATE TABLE IF NOT EXISTS equipos (
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  ciudad VARCHAR(100),
  img VARCHAR(255), -- Nueva columna para la imagen del equipo
  fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP,
  estatus TINYINT(1) DEFAULT 1
);

-- Crear tabla para la tabla de posiciones
CREATE TABLE IF NOT EXISTS tabla_posiciones (
  id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_equipo TINYINT UNSIGNED NOT NULL,
  partidos_jugados TINYINT UNSIGNED DEFAULT 0,
  partidos_ganados TINYINT UNSIGNED DEFAULT 0,
  partidos_empatados TINYINT UNSIGNED DEFAULT 0,
  partidos_perdidos TINYINT UNSIGNED DEFAULT 0,
  goles_favor TINYINT UNSIGNED DEFAULT 0,
  goles_contra TINYINT UNSIGNED DEFAULT 0,
  goles_diferencia INT AS (CAST(goles_favor AS SIGNED) - CAST(goles_contra AS SIGNED)) STORED,
  puntos TINYINT UNSIGNED DEFAULT 0,
  fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha_alta DATETIME DEFAULT CURRENT_TIMESTAMP,
  estatus TINYINT(1) DEFAULT 1,
  CONSTRAINT fk_equipo FOREIGN KEY (id_equipo) REFERENCES equipos (id)
);

-- Crear tabla para roles
CREATE TABLE IF NOT EXISTS roles (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  descripcion TEXT
);


-- Crear tabla para usuarios sin SET NULL en DELETE
CREATE TABLE IF NOT EXISTS usuarios (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  id_rol INT UNSIGNED NOT NULL DEFAULT 2, -- Asigna automáticamente el rol de usuario
  fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
  estatus TINYINT(1) DEFAULT 1,
  CONSTRAINT fk_rol FOREIGN KEY (id_rol) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
);
