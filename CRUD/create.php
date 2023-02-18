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

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if ($conn->multi_query($sql) === TRUE) {
  echo "Se ha añadido la información correctamente";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>