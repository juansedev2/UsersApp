<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/NavProfileUser.css">
    <link rel="stylesheet" href="/public/css/CreateUser.css">
    <?php include_once "./public/partials/Favicon.html"?>
</head>
<body>
    <?php include_once "./public/partials/NavProfileUser.html"?>
    <section id="tittle">
        <h1>Crear ususario</h1>
        <?php if(UserController::isthereAlert()):?>
            <h2><?=UserController::getAlert()?></h2>
        <?php endif;?>
    </section>
    <main id="section_form">
        <?php require_once "./public/partials/FormCreateUser.view.php"?>
    </main>
    <script src="/public/js/CreateUser.js"></script>
</body>
</html>