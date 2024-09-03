<?php
try{
$connectionString = "mysql:host=localhost;dbname=c17_proj";
$user = "root";
$pass = "";
$pdo = new PDO($connectionString, $user, $pass);
$pdo ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    die($e->getMessage());
}

?>

