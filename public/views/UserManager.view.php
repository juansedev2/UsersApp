<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar usuarios</title>
    <?php include_once "./public/partials/Favicon.html"?>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/NavMenu.css">
    <link rel="stylesheet" href="/public/css/UserManager.css">
</head>
<body>
    <?php require_once "./public/partials/NavProfileUser.html"?>
    <section id="administration_tittle">
        <h1>Administración de usuarios</h1>
    </section>
    <main id="users_table">
        <table>
            <thead>
                <tr>
                    <th>Id usuario</th>
                    <th>Nombre completo</th>
                    <th>Ver usuario</th>
                    <th>Editar usuario</th>
                    <th>Eliminar usuario</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user):?>
                    <tr>
                        <td><?=$user->properties["id"]?></td>
                        <td><?=$user->properties["first_name"]. " " . $user->properties["middle_name"] . " " . $user->properties["last_name"]?></td>
                        <td>
                            <form action="consultar-usuario" method="post">
                                <input type="number" value="<?=$user->properties["id"]?>" hidden>
                                <button class="button eye">
                                    <img src="/public/assets/icons/eye.ico" alt="Icono de visualizar no encontrado" class="icon">
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="editar-usuario" method="post">
                                <input type="number" value="<?=$user->properties["id"]?>" hidden>
                                <button class="button pencil">
                                    <img src="/public/assets/icons/pencil.ico" alt="Icono de editar no encontrado" class="icon">
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="eliminar-usuario" method="post">
                                <input type="number" value="<?=$user->properties["id"]?>" hidden>
                                <button class="button pencil">
                                    <img src="/public/assets/icons/trash.ico" alt="Icono de eliminar no encontrado" class="icon">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </main>
</body>
</html>