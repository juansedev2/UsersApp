<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida administrador</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/Administratror.css">
    <?php include_once "./public/partials/Favicon.html"?>
</head>
<body>
    <main id="section_administrator_menu">
        <section id="section_tittle">
            <h1>Bienvenido administrador: <?= $_SESSION["name"]?></h1>
        </section>
        <section id="section_administrator_options">
            <div class="section_options">
                <img src="/public/assets/img/UserIcon.jpg" alt="Imagen no encontrada" width="150px">
                <a href="perfil">Ver tu perfil</a>
            </div>
            <div class="section_options">
                <img src="/public/assets/img/Users-icon.jpg" alt="Imagen no encontrada" width="150px">
                <a href="administrar">Administrar usuarios</a>
            </div>
            <div class="section_options">
                <img src="/public/assets/img/Exit.jpg" alt="Imagen no encontrada" width="150px">
                <a href="salir">Salir</a>
            </div>
        </section>
    </main>
</body>
</html>