CREATE TABLE publicaciones (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, usuario VARCHAR(200), ruta VARCHAR(200));

CREATE TABLE solicitudes (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, usuario VARCHAR(200), destino VARCHAR(200));

CREATE TABLE amigos (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, usuario VARCHAR(200), usuario2 VARCHAR(200));

CREATE TABLE chat (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, usuario VARCHAR(200), destino VARCHAR(200), mensaje VARCHAR(200), fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);