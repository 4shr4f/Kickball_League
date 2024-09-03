<?php
require_once "db.inc";
try{
$connectionString = "mysql:host=localhost;dbname=c17_ashraf";
$user = "root";
$pass = "";
$pdo = new PDO($connectionString, $user, $pass);
$pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    die($e->getMessage());
}

?>

