<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="/public/css/Normalize.css">
    <link rel="stylesheet" href="/public/css/ProfileData.css">
    <link rel="stylesheet" href="/public/css/NavProfileUser.css">
    <?php include_once "./public/partials/Favicon.html"?>
</head>
<body>
    <?php include_once "./public/partials/NavProfileUser.html"?>
    <section id="section_profile_tittle">
        <h1>Usuario/a: <?=$_SESSION["name"]?></h1>
        <?php include_once "./public/partials/AlertUpdateProfile.view.php"?>
    </section>
    <section id="section_profile_data">
        <?php include_once "./public/partials/FormPersonalDataGeneral.view.php"?>
    </section>
</body>
</html>