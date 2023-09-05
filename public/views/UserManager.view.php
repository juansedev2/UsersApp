<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/NavMenu.css">
    <?php include_once "./public/partials/Favicon.html"?>
</head>
<body>
    <?php require_once "./public/partials/NavProfileUser.html"?>
    <section id="administration_tittle">
        <h1>Administración de usuarios</h1>
    </section>
    <main id="users_table">
        <table border="1">
            <tr>
                <th>Id usuario</th>
                <th>Nombre completo</th>
                <th>Ver usuario</th>
                <th>Editar usuario</th>
                <th>Eliminar usuario</th>
            </tr>
            <?php foreach ($users as $user):?>
                <tr>
                    <td><?=$user->properties["id"]?></td>
                    <td><?=$user->properties["first_name"]. " " . $user->properties["middle_name"] . " " . $user->properties["last_name"]?></td>
                    <td><img src="/public/assets/icons/eye.ico" alt="Icono de visualizar no encontrado"></td>
                    <td><img src="/public/assets/icons/pencil.ico" alt="Icono de lapiz no encontrado"></td>
                    <td><img src="/public/assets/icons/trash.ico" alt="Icono de caneca no encontrado"></td>
                </tr>
            <?php endforeach?>
        </table>
    </main>
</body>
</html>