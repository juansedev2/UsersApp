<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/NavProfileUser.css">
    <link rel="stylesheet" href="/public/css/FullProfileUser.css">
    <?php include_once "./public/partials/Favicon.html"?>
</head>
<body>
    <?php include_once "./public/partials/NavProfileUser.html"?>
    <section id="tittle">
        <h1>Editar ususario</h1>
        <?php include_once "./public/partials/AlertUpdateProfile.view.php"?>
    </section>
    <main id="section_form">
        <?php require_once "./public/partials/FullProfileUserEdit.view.php"?>
    </main>
</body>
</html>