<?php
// Datos para la conexion
$server = "localhost";
$username = "root";
$password = "";

// Creamos la conexion
$conn = new mysqli($server,$username,$password);

// Comprobamos la conexion
if($conn->connect_error){
    die("La conexión ha fallado: ".$conn->connect_error);
}
echo "Conexión correcta";
?>