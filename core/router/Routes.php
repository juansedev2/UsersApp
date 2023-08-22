<?php

// This file return all of the valid routes defined for the app

return [
    "" => ["StaticController", "showLanding"],
    "registro" => ["StaticController", "showRegister"],
    "acerca" => ["StaticController", "showAbout"],
    "login" => ["LoginController", "showLogin"],
    "login-form" => ["LoginController", "validateLogin"],
];