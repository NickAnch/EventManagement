<?php
    class Db{
        public static function getConnection(){
            //$paramsPath = ROOT. '/config/db_params.php';
            //$params = include($paramsPath);
            $host = 'localhost';
            $dbname = 'meetup';
            $user = 'root';
            $password = '1234admin';
            $db = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
            
            //$dsn = "mysql:host = {$params['host']};dbname = {$params['dbname']}";
            //$db = new PDO("mysql:host = {$params['host']};dbname = {$params['dbname']}", $params['user'], $params['password']);

            return $db;
        } 
    }
?>