<?php
    class Db{
        public static function getConnection(){
            $host = 'localhost';
            $dbname = 'meetup';
            $user = 'root';
            $password = '1234admin';
            $db = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);

            return $db;
        }
    }
?>
