CREATE DATABASE tienda;

USE tienda;

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','usuario') NOT NULL
);

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    cantidad INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    fecha DATETIME,
    total DECIMAL(10,2),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

CREATE TABLE detalle_ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venta_id INT,
    producto_id INT,
    cantidad INT,
    precio DECIMAL(10,2),
    subtotal DECIMAL(10,2),
    FOREIGN KEY (venta_id) REFERENCES ventas(id),
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO usuarios (nombre, correo, password, rol)
VALUES (
    'Administrador',
    'admin@gmail.com',
    'admin12345',
    'admin'
);