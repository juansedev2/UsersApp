<?php
/**
* This file get all of the necessary files to init the app, how config, database, etc., also is the is the core file that does inclusion of core files
*/
require_once "./core/testing/Functions.php";
require_once "./core/Injector.php";
require_once "./core/database/DBConnection.php";
require_once "./core/database/QueryBuilder.php";
require_once "./app/models/Model.php";
require_once "./app/models/User.php";
require_once "./app/controllers/BaseController.php";
require_once "./app/controllers/StaticController.php";
require_once "./app/controllers/LoginController.php";

Injector::set("config", require_once "./core/config/Config.php");
Injector::set("QueryBuilder", new QueryBuilder(DBConecction::tryConnection(Injector::get("config")["database"])));

// Define the status of the app in production for show the errors|
if(Injector::get("config")["production"]){
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '0');
    ini_set('track_errors', 'On');
}else{
    ini_set('display_errors', '1');
}

//$user = new User();
//dd($user->queryUser("jadmin2v@email.com", "$2y$11\$Y.wlkaUdPN5BpVLuJiTsKOpDOUTcmjl8voXjFD8Z64elmb6LbD6.C"));