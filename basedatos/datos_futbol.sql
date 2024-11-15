-- Insertar roles básicos: admin y usuario
INSERT IGNORE INTO roles (id, nombre, descripcion) VALUES 
(1, 'admin', 'Administrador con acceso completo al sistema'),
(2, 'usuario', 'Usuario estándar con permisos limitados');

INSERT INTO usuarios (username, email, password, id_rol)
VALUES ('admin', 'admin@example.com', 'admin', 1);


-- Inserciones en la tabla de equipos con columna img
INSERT INTO equipos (nombre, ciudad, img, estatus)
VALUES
('Huracán', 'Buenos Aires', '../img/EscudosFutbol/Huracan.png', 1),
('Unión', 'Santa Fe', '../img/EscudosFutbol/Union.png', 1),
('Atlético Tucumán', 'Tucumán', '../img/EscudosFutbol/AtleticoTucuman.png', 1),
('Vélez Sarsfield', 'Buenos Aires', '../img/EscudosFutbol/VelezSarsfield.png', 1),
('Racing Club', 'Avellaneda', '../img/EscudosFutbol/RacingClub.png', 1),
('Talleres', 'Córdoba', '../img/EscudosFutbol/Talleres.png', 1),
('Instituto', 'Córdoba', '../img/EscudosFutbol/Instituto.png', 1),
('Boca Juniors', 'Buenos Aires', '../img/EscudosFutbol/BocaJuniors.png', 1),
('River Plate', 'Buenos Aires', '../img/EscudosFutbol/RiverPlate.png', 1),
('Lanús', 'Lanús', '../img/EscudosFutbol/Lanus.png', 1),
('Belgrano', 'Córdoba', '../img/EscudosFutbol/Belgrano.png', 1),
('Estudiantes de La Plata', 'La Plata', '../img/EscudosFutbol/Estudiantes.png', 1),
('Rosario Central', 'Rosario', '../img/EscudosFutbol/RosarioCentral.png', 1),
('Godoy Cruz Antonio Tomba', 'Mendoza', '../img/EscudosFutbol/GodoyCruz.png', 1),
('Independiente Rivadavia', 'Mendoza', '../img/EscudosFutbol/IndependienteRivadavia.png', 1),
('Deportivo Riestra', 'Buenos Aires', '../img/EscudosFutbol/DeportivoRiestra.png', 1),
('Gimnasia La Plata', 'La Plata', '../img/EscudosFutbol/Gimnasia.png', 1),
('Independiente', 'Avellaneda', '../img/EscudosFutbol/Independiente.png', 1),
('Sarmiento', 'Junín', '../img/EscudosFutbol/Sarmiento.png', 1),
('Barracas Central', 'Buenos Aires', '../img/EscudosFutbol/BarracasCentral.png', 1),
('San Lorenzo', 'Buenos Aires', '../img/EscudosFutbol/SanLorenzo.png', 1),
('Defensa y Justicia', 'Florencio Varela', '../img/EscudosFutbol/DefensaYJusticia.png', 1);


-- Inserciones en la tabla de posiciones
INSERT INTO tabla_posiciones (id_equipo, partidos_jugados, partidos_ganados, partidos_empatados, partidos_perdidos, goles_favor, goles_contra, puntos)
VALUES
(1, 11, 6, 5, 0, 12, 4, 23),
(2, 11, 6, 4, 1, 13, 5, 22),
(3, 11, 6, 4, 1, 13, 7, 22),
(4, 11, 6, 3, 2, 17, 8, 21),
(5, 11, 6, 2, 3, 18, 12, 20),
(6, 11, 6, 2, 3, 18, 12, 20),
(7, 11, 6, 2, 3, 13, 8, 20),
(8, 11, 4, 7, 0, 15, 10, 19),
(9, 11, 5, 4, 2, 13, 9, 19),
(10, 11, 4, 4, 3, 16, 17, 16),
(11, 11, 4, 4, 3, 14, 15, 16),
(12, 11, 4, 3, 4, 13, 11, 15),
(13, 11, 4, 3, 4, 13, 11, 15),
(14, 10, 4, 3, 3, 11, 9, 15),
(15, 11, 4, 3, 4, 14, 13, 15),
(16, 11, 4, 3, 4, 13, 15, 15),
(17, 11, 4, 2, 5, 14, 16, 14),
(18, 11, 4, 2, 5, 8, 9, 14),
(19, 11, 2, 5, 4, 9, 16, 11),
(20, 11, 2, 2, 7, 5, 20, 8),
(21, 11, 1, 3, 7, 6, 22, 6),
(22, 11, 1, 1, 9, 5, 24, 4);

-- Inserciones en la tabla de noticias
INSERT INTO noticias (titulo, descripcion, img, estatus)
VALUES
('Título de la Noticia 1', 'Breve descripción de la noticia 1.', '../img/noticias/noticia1.jpg', 1),
('Título de la Noticia 2', 'Breve descripción de la noticia 2.', '../img/noticias/noticia2.jpg', 1),
('Título de la Noticia 3', 'Breve descripción de la noticia 3.', '../img/noticias/noticia3.jpg', 1),
('Título de la Noticia 4', 'Breve descripción de la noticia 4.', '../img/noticias/noticia4.jpg', 1);


