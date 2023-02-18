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

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Pintamos la información
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "No hay resultados";
}
$conn->close();
?>