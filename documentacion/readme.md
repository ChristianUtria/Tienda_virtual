### CUENTA DE ADMINISTRADOR
Pasos para configurar el repositorio localmente
Correo: admin@gmail.com

Contraseña: admin12345

1. Ubicación del proyecto
Clona o descarga el repositorio dentro de la carpeta de trabajo de XAMPP:

Ruta: C:\xampp\htdocs\Tienda_virtual

2. Encendido de servicios en XAMPP
Abre el Panel de Control de XAMPP.

Inicia los servicios Apache y MySQL haciendo clic en Start.

3. Configuración de la Base de Datos en phpMyAdmin
Entra a http://localhost/phpmyadmin desde tu navegador.

Haz clic en Nueva en el menú izquierdo y crea la base de datos para el proyecto.

Selecciona la base de datos recién creada y ve a la pestaña Importar.

Haz clic en Seleccionar archivo y busca el archivo de extensión .sql ubicado en la estructura del proyecto 

Presiona Continuar para ejecutar la creación de tablas y estructura.

4. Creación del Usuario Administrador
Si la base de datos importada no incluye el usuario por defecto, dirígete a la pestaña SQL dentro de phpMyAdmin y ejecuta la consulta correspondiente a la tabla de usuarios de tu proyecto:

SQL
INSERT INTO usuarios (email, password, rol) 
VALUES ('admin@gmail.com', 'admin12345', 'admin');


5. Ejecución de la aplicación
Accede desde el navegador a la URL del proyecto:

http://localhost/Tienda_virtual/
E inicia sesión en el módulo correspondiente con:

