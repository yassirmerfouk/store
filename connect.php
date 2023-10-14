<?php
$dsn = 'mysql:host=localhost;dbname=php_store';
$user = 'root';
$pass = '';
try
{
    $con = new PDO($dsn, $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
}
catch(PDOException $e)
{
   echo "FAILED TO CONNECT " . $e->getMessage() . "<br>";
}
?>