# Documentación de rápida instalación

## Aplicación: UsersApp

### Autor: Juansedev2

---

Es una aplicación de administración de usuarios, contempla el uso de roles, operaciones CRUD con ellos, sesiones, seguridad y validaciones.

---

Para usar la aplicación en entorno de desarrollo, clona el repositorio, luego puedes acceder a la misma a través del servidor local de PHP:

- Accede vía terminal al directorio de la app en la raíz y utiliza el siguiente comando:

```conf
    php -S localhost:3000
```

- **Antes de continuar, descarga el archivo de backup de la base de datos ubicado en el directorio de docs y cargar en PHPMYADMIN el archivo y dado que es entorno de desarrollo, puedes dejar usuario root y contraseña vacia = ""**

- A través de XAMPP, deja activado el servicio de Apache y MySQL (revisa la configuración de la aplicación si llegas a tener problemas de conexión **core/conf/Config.php**)

- Luego Accede al navegador web por esa misma dirección y deberías ver la aplicación en funcionamiento

Si lo que necesitas ver es un ejemplo de puesta en un servidor de producción, por favor dirígete a la rama de producción: **production**

**Ante cualquier novedad que presentes o tengas alguna duda, puede enviarme un mensaje a infojuansedev2@gmail.com.**
