# Documentación de producción

## Aplicación: UsersApp

### Autor: Juansedev2

#### Ejemplo de puesta de producción a través del servidor Apache vía virtual host

---

Para poder poner la aplicación en un entorno de producción como en el servidor Apache, según la documentación ofical del mismo entorno, se puede crear un entorno de desarrollo. Para lo más básico que es la puesta en producción de manera rápida, seguir los siguientes pasos:

1. Agregar un host virtual en el S.O vía hosts
1. Configurar un virtual Host en el archivo httpd-vhosts.conf de la configuración de XAMPP

```conf
    <VirtualHost *:80>
        DocumentRoot "C:/xampp/htdocs/"
        ServerName localhost
    </VirtualHost>
    <VirtualHost *:80>
        DocumentRoot "C:/xampp/htdocs/Curso_PHP/Proyectos/UsersApp"
        ServerName appusers.test
    </VirtualHost>
```
