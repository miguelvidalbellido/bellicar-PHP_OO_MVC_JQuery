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

$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

if ($conn->query($sql) === TRUE) {
  echo "Registro actualizado correctamente";
} else {
  echo "Error actualizando el registro: " . $conn->error;
}

$conn->close();
?>