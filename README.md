# Technician Test Marcos

## Acerca del proyecto

Prueba técnica
Proyecto generado en [Laravel](https://laravel.com/)

## Despliegue local

Dentro del directorio deseado, ejecuta el comando ``` git clone https://github.com/MarkOsBab/technician-test-quickdrink.git ``` para clonar el proyecto.

Si no tienes instalado Docker, puedes descargarlo [aqui](https://docs.docker.com/desktop/).

Levanta los contenedores de Docker ejecuta el comando ``` docker-compose up ```.

* technician_test-app: Es la aplicación desarrollada con laravel
* technician_test-nginx: Servidor web que expone la API el acceso ene el puerto 8400
* technician_test-phpmyadmin: Despliegue de las tablas.
* technician_test-mysql: Servidor de mysql para levantar la base de datos.

Todos los puertos se pueden modificar en el archivo [docker-compose.yml](https://github.com/MarkOsBab/technician-test-quickdrink/blob/main/docker-compose.yml)

Actualiza todos los paquetes de la aplicación. Dentro del contenedor de la aplicación correspondiente a la API ejecuta el comando ``` docker-compose exec app php artisan composer update ```

Se deberá utilizar el comando ``` php artisan migrate ``` para ejecutar las migraciones de laravel.

De ser necesario, modifica la configuración correspondiente al entorno local .env.

Podrás acceder al sitio desde la siguiente dirección ``` http://localhost:8400/ ```.

