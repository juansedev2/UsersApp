<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="juansedev2">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/NavMenu.css">
    <link rel="stylesheet" href="/public/css/Login.css">
</head>
<body>
    <?php require "./public/partials/NavMenu.html" ?>
    <section id="login_section">
        <form action="login-form" method="POST">
            <h1>Iniciar sesión</h1>
            <div class="credentials email">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" required="true">
            </div>
            <div class="credentials password">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required="true">
            </div>
            <div class="button">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </section>
</body>
</html>