<?php
include_once("connect.php");
$result = mysqli_query($mysqli, "SELECT * FROM cars ORDER BY id ASC");
//die('<script>console.log('.json_encode( $result->num_rows ) .');</script>');
?>

<html>
<head>
    <title>Pagina inicial</title>
</head>
<body>
    <a href="add.php">Añadir un coche nuevo</a><br/><br/>
    <!-- Creamos la tabla donde mostraremos los coches almacenados en la db -->
    <table width="80%" border=0>

    <tr bgcolor='#CCCCCC'>
		<td>id</td>
		<td>numero_licencia</td>
		<td>marca</td>
		<td>modelo</td>
        <td>matricula</td>
        <td>km</td>
        <td>categoria</td>
        <td>tipo</td>
        <td>comentarios</td>
        <td>Feha de alta</td>
        <td>Color</td>
        <td>Extras</td>
        <td>Car image</td>
        <td>Precio</td>
        <td>Nº puertas</td>
        <td>Ciudad</td>
        <td>latitud</td>
        <td>longitud</td>
	</tr>
    <!-- Comprobamos si hay datos y los pintamos en la tabla -->
    <?php
    while($res = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>".$res["id"]."</td>";
        echo "<td>".$res["license_number"]."</td>";
        echo "<td>".$res["brand"]."</td>";
        echo "<td>".$res["model"]."</td>";
        echo "<td>".$res["car_plate"]."</td>";
        echo "<td>".$res["km"]."</td>";
        echo "<td>".$res["category"]."</td>";
        echo "<td>".$res["type"]."</td>";
        echo "<td>".$res["comments"]."</td>";
        echo "<td>".$res["discharge_date"]."</td>";
        echo "<td>".$res["color"]."</td>";
        echo "<td>".$res["extras"]."</td>";
        echo "<td>".$res["car_image"]."</td>";
        echo "<td>".$res["price"]."</td>";
        echo "<td>".$res["doors"]."</td>";
        echo "<td>".$res["city"]."</td>";
        echo "<td>".$res["lat"]."</td>";
        echo "<td>".$res["lng"]."</td>";
        echo "<td><a href=\"update.php?id=$res[id]\">Edit<a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('¿Esta seguro que desea eliminarlo?')\">Delete</a></td>";

    }
    ?>
    </table>
</body>
</html>