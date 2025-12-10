<?php

$host = "localhost"; // Dirección del servidor
$port = "3307";      // Puerto del servidor MySQL (por defecto 3306)
$nombreBD = "videojuego"; // Nombre de la BD
$usuario = "root";   // Usuario con acceso a la BD
$password = "";      // Contraseña del usuario

$dsn = "mysql:host=$host;port=$port;dbname=$nombreBD";



 try {

 $pdo = new PDO($dsn, $usuario, $password);



 } catch (\PDOException $e) {
 throw new \PDOException($e->getMessage(), (int)$e->getCode());
 }

?>
