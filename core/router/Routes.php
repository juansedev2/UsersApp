<?php
// This file return all of the valid routes defined for the app
return [
    "" => ["StaticController", "showLanding"],
    "registro" => ["StaticController", "showRegister"],
    "acerca" => ["StaticController", "showAbout"],
    "login" => ["SessionController", "showLogin"],
    "login-form" => ["SessionController", "tryLogin"],
    "menu" => ["SessionController", "showMenu"],
    "salir" => ["SessionController", "closeSession"],
    "perfil" => ["UserController", "showProfile"],
    "actualizar-perfil" => ["UserController", "updateUserProfile"],
    "administrar" => ["UserController", "showAdministration"],
    "404" => ["StaticController", "show404"],
    "500" => ["StaticController", "showInternalServerError"],
];