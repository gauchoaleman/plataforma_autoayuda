# miweb
Repositorio Tesina 2019

Hacer esto para instalar:

Crear usuario admin con clave adminspassword en mysql: CREATE USER 'admin'@'localhost' IDENTIFIED BY 'adminspassword';

Crear base de datos autoayuda en mysql: CREATE DATABASE autoayuda;

Ejecutar las queries del directorio /sql: tablas_y_datos.sql

Si hace falta, ejecutar estas 2 líneas:

php artisan key:generate

php artisan config:cache
