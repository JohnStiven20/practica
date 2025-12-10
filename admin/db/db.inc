<?php

$host = "localhost";
$nombreBS = "videojuego";
$usuario = "root";
$password = "";



$con = new mysqli($host, $usuario, $password, $nombreBS);

if ($con->connect_error) {
    die("La Conexion es errror" . $con -> connect_error);
}


?>