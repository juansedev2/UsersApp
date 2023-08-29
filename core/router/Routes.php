<?php
// This file return all of the valid routes defined for the app
return [
    "" => ["StaticController", "showLanding"],
    "registro" => ["StaticController", "showRegister"],
    "acerca" => ["StaticController", "showAbout"],
    "login" => ["SessionController", "showLogin"],
    "login-form" => ["SessionController", "tryLogin"],
    "menu" => ["SessionController", "showMenu"],
    "salir" => ["SessionController", "closeSession"]
];