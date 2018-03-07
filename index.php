<?php
ini_set('display_errors','1');  //
error_reporting(E_ALL);         //Включение проверки на ошибки

define('ROOT', dirname(__FILE__));// dirname - абсолютный путь до MeetUps
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');

session_start();

//Вызов Router
$router = new Router();
$router->run();
?>
