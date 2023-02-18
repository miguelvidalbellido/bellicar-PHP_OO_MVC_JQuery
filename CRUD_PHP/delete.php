<?php
//die('<script>console.log("hola");</script>');
// Importamos el fichero con los datos para la conexion
include("connect.php");
//die('<script>console.log('.json_encode( $_GET['id'] ) .');</script>');
// Obtenemos el id recibido por GET
$id = $_GET['id'];

// Eliminamos el registro de la BD
$result = mysqli_query($mysqli, "DELETE FROM cars WHERE id=$id");

// Redireccionamos al inicio
header("Location: index.php");
?>