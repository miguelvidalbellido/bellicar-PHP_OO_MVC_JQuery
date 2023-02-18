<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";

// Creamos la conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobamos la conexion
if ($conn->connect_error) {
  die("Conexion Erronea: " . $conn->connect_error);
}

// Creamos la peticion sql para borrar
$sql = "DELETE FROM MyGuests WHERE id=3";

if ($conn->query($sql) === TRUE) {
  echo "Se ha borrado correctamente el registro";
} else {
  echo "Error al borrar el registro: " . $conn->error;
}

$conn->close();
?>