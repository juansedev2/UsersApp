<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida administrador</title>
    <link rel="stylesheet" href="/public/css/Administratror.css">
</head>
<body>
    <main>
        <h1>Bienvenido administrador: <?= $_SESSION["name"]?></h1>
        <section>
            <div>
                <img src="/public/assets/img/UserIcon.jpg" alt="Imagen no encontrada" width="100px">
                <a href="perfil">Ver tu perfil</a>
            </div>
            <div>
                <img src="/public/assets/img/Users-icon.jpg" alt="Imagen no encontrada" width="100px">
                <a href="administrar">Administrar usuarios</a>
            </div>
            <div>
                <img src="/public/assets/img/Exit.jpg" alt="Imagen no encontrada" width="100px">
                <a href="salir">Salir</a>
            </div>
        </section>
    </main>
</body>
</html>