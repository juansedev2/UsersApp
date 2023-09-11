# Documentación de producción

## Aplicación: UsersApp

### Autor: Juansedev2

#### Ejemplo de puesta de producción a través del servidor Apache vía virtual host

---

Para poder poner la aplicación en un entorno de producción como en el servidor Apache, según la documentación ofical del mismo entorno, se puede crear un entorno de desarrollo. Para lo más básico que es la puesta en producción de manera rápida, seguir los siguientes pasos:

1. Agregar un host virtual en el S.O vía hosts

En Windows, se acceder al archivo de hosts, ubicado en el directorio: C:\Windows\System32\drivers\etc, **(Se debe acceder como administrador para editarlo y guardarlo, tampoco agregar host terminado en .com por conflicto de dominios)**, luego agregar un host local como por ejemplo:

```conf
    127.0.0.1 appusers.test
```

1. Asegurarse que XAMPP esté instalado y funcionando correctamente, luego seguir los demás pasos:

Cargar en SGBD PHPMYADMIN el archivo de backup de bases de datos compartido en el directorio de documentación, luego cargarlo en el SGBD y seguir con la configuración (si deseas agregar/configurar usuarios, puedes hacerlo, por defecto es root y contraseña vacia: ""), luego encender el servicio MySQL

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

1. Apagar el servicio Apache y reiniciarlo (o incluso reiniciar XAMPP), luego volver a acceder

1. Acceder vía navegador web a la aplicación de acuerdo al nobmre del servidor via URL, que según el ejemplo, sería:

```conf
    http://appusers.test o appusers.test
    (según el nombre del host dado)
```

1. Si finalmente todo ha salido bien, se debería poder ver algo como esto en la URL y en pantalla al acceder:

![AppTestimg](https://github.com/juansedev2/UsersApp/blob/production/docs/Diagramas%20img/Test%20img/AppVHOST.PNG)

**Ante cualquier novedad que presentes o tengas alguna duda, puede enviarme un mensaje a infojuansedev2@gmail.com.**
