# Documentación de producción

## Aplicación: UsersApp

### Autor: Juansedev2

#### Ejemplo de puesta de producción a través del servidor Apache vía virtual host

---

Para poder poner la aplicación en un entorno de producción como en el servidor Apache, según la documentación ofical del mismo entorno, se puede crear un entorno de desarrollo. Para lo más básico que es la puesta en producción de manera rápida, seguir los siguientes pasos:

1. Agregar un host virtual en el S.O vía hosts

En Windows, se acceder al archivo de hosts, ubicado en el directorio: C:\Windows\System32\drivers\etc, **(Se debe acceder como administrador para editarlo y guardarlo)**, luego agregar un host local como por ejemplo:

```conf
    127.0.0.1 appusers.test
```

1. Asegurarse que XAMPP esté instalado y funcionando correctamente, luego seguir los demás pasos:

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

![App Test img](https://raw.githubusercontent.com/juansedev2/UsersApp/production/docs/Diagramas img/Test img/AppVHOST.PNG)
