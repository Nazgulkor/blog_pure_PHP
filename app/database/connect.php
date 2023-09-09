<?php
$driver = 'mysql';
$host = 'localhost';
$db_name = 'dinamic_site';
$user_name = 'root';
$user_password = 'mysql';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
try{
    $pdo = new PDO("$driver:host=$host;dbname=$db_name;charset=$charset",
                    $user_name, $user_password, $options);
} catch(PDOException $i){
    die("Error!: " . $i->getMessage() . "<br/>");
}