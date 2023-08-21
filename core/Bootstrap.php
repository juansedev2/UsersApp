<?php
/**
* This file get all of the necessary files to init the app, how config, database, etc., also is the is the core file that does inclusion of core files
*/
require_once "./core/testing/Functions.php";
$config = require_once "./core/config/Config.php";
require_once "./core/database/DBConnection.php";

DBConecction::tryConnection($config["database"]);