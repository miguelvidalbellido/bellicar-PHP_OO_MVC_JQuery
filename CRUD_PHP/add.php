<?php
// Exportamos los datos para acceder a la BD
include_once("connect.php");

if(isset($_POST["Submit"])){
    
    // Obtenemos los datos mediante POST y los almacenamos en variables locales
    $license_number = mysqli_real_escape_string($mysqli,$_POST['license_number']);
    die('<script>console.log('.json_encode( $license_number ) .');</script>');

    $brand = mysqli_real_escape_string($mysqli,$_POST['brand']);
    $model = mysqli_real_escape_string($mysqli,$_POST['model']);
    $car_plate = mysqli_real_escape_string($mysqli,$_POST['car_plate']);
    $km = mysqli_real_escape_string($mysqli,$_POST['km']);
    $category = mysqli_real_escape_string($mysqli,$_POST['category']);
    $type = mysqli_real_escape_string($mysqli,$_POST['type']);
    $comments = mysqli_real_escape_string($mysqli,$_POST['comments']);
    $discharge_date = mysqli_real_escape_string($mysqli,$_POST['discharge_date']);
    $color = mysqli_real_escape_string($mysqli,$_POST['color']);
    $extras = mysqli_real_escape_string($mysqli,$_POST['extras']);
    $car_image = mysqli_real_escape_string($mysqli,$_POST['car_image']);
    $price = mysqli_real_escape_string($mysqli,$_POST['price']);
    $doors = mysqli_real_escape_string($mysqli,$_POST['doors']);
    $city = mysqli_real_escape_string($mysqli,$_POST['city']);
    $lat = mysqli_real_escape_string($mysqli,$_POST['lat']);
    $lng = mysqli_real_escape_string($mysqli,$_POST['lng']);
    echo "<script>console.log('ERROR');</script>";
    // Comprobamos que todos los campos tengan valor

    if(empty($license_number) || empty($brand) || empty($model) || empty($car_plate) ||
    empty($km) ||empty($category) || empty($type) || empty($comments) || empty($discharge_date) ||
    empty($color) || empty($extras) || empty($car_image) || empty($price) || empty($doors) || empty($city) || empty($lat) || empty($lng)){
        echo "<script>console.log('ERROR1');</script>";
        // Avisamos de los campos vacios
        if(empty($license_number)){
            echo "<font color='red'>License nummber se encuentra vacio.</font><br/>";
        }
        if(empty($brand)){
            echo "<font color='red'>Brand se encuentra vacio.</font><br/>";
        }
        if(empty($model)){
            echo "<font color='red'>Model se encuentra vacio.</font><br/>";
        }
        if(empty($car_plate)){
            echo "<font color='red'>Car plate se encuentra vacio.</font><br/>";
        }
        if(empty($km)){
            echo "<font color='red'>Km se encuentra vacio.</font><br/>";
        }
        if(empty($category)){
            echo "<font color='red'>Category se encuentra vacio.</font><br/>";
        }
        if(empty($type)){
            echo "<font color='red'>Type se encuentra vacio.</font><br/>";
        }
        if(empty($comments)){
            echo "<font color='red'>Comments se encuentra vacio.</font><br/>";
        }
        if(empty($discharge_date)){
            echo "<font color='red'>Discharge date se encuentra vacio.</font><br/>";
        }
        if(empty($color)){
            echo "<font color='red'>Color se encuentra vacio.</font><br/>";
        }
        if(empty($extras)){
            echo "<font color='red'>Extras se encuentra vacio.</font><br/>";
        }
        if(empty($car_image)){
            echo "<font color='red'>Car image se encuentra vacio.</font><br/>";
        }
        if(empty($price)){
            echo "<font color='red'>Price se encuentra vacio.</font><br/>";
        }
        if(empty($doors)){
            echo "<font color='red'>Doors se encuentra vacio.</font><br/>";
        }
        if(empty($city)){
            echo "<font color='red'>City se encuentra vacio.</font><br/>";
        }
        if(empty($lat)){
            echo "<font color='red'>lat se encuentra vacio.</font><br/>";
        }
        if(empty($lng)){
            echo "<font color='red'>lng se encuentra vacio.</font><br/>";
        }
    } else {
        die('<script>console.log('.json_encode( $license_number ) .');</script>');
        // Actualizamos el registro en la BD
        $result = mysqli_query($mysqli, "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng) VALUES('$license_number','$brand','$model','$car_plate','$km','$category',
        '$type','$comments','$discharge_date','$color','$extras','$car_image','$price','$doors','$city','$lat','$lng')");
        
        // Mostramos el ok de la operación y pintamos el boton para volver al inicio
        echo "<font color='green'>La información ha sido añadida de forma exitosa.";
        echo "<br/><a href='index.php'>Comprobar resultado</a>";
        echo "<script>console.log('ERROR2');</script>";
    }
}
?>




<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir coche</title>
</head>
<body>
<a href="index.php">Home</a>
	<br/><br/>

	<form action="add.php" method="post" name="form1">
		<table width="25%" border="0">
			<tr> 
				<td>Numero_licencia</td>
				<td><input type="text" name="license_number"></td>
			</tr>
			<tr> 
				<td>Marca</td>
				<td><input type="text" name="brand"></td>
			</tr>
			<tr> 
				<td>Modelo</td>
				<td><input type="text" name="model"></td>
			</tr>
            <tr> 
				<td>matricula</td>
				<td><input type="text" name="car_plate"></td>
			</tr>
            <tr> 
				<td>km</td>
				<td><input type="text" name="km"></td>
			</tr>
            <tr> 
				<td>categoria</td>
				<td><input type="text" name="category"></td>
			</tr>
            <tr> 
				<td>tipo</td>
				<td><input type="text" name="type"></td>
			</tr>
            <tr> 
				<td>comentarios</td>
				<td><input type="text" name="comments"></td>
			</tr>
            <tr> 
				<td>Feha de alta</td>
				<td><input type="text" name="discharge_date"></td>
			</tr>
            <tr> 
				<td>Color</td>
				<td><input type="text" name="color"></td>
			</tr>
            <tr> 
				<td>Extras</td>
				<td><input type="text" name="extras"></td>
			</tr>
            <tr> 
				<td>Car image</td>
				<td><input type="text" name="car_image"></td>
			</tr>
            <tr> 
				<td>Precio</td>
				<td><input type="number" name="price"></td>
			</tr>
            <tr> 
				<td>Nº puertas</td>
				<td><input type="number" name="doors"></td>
			</tr>
            <tr> 
				<td>Ciudad</td>
				<td><input type="text" name="city"></td>
			</tr>
            <tr> 
				<td>latitud</td>
				<td><input type="number" name="lat"step="any"></td>
			</tr>
            <tr> 
				<td>longitud</td>
				<td><input type="number" name="lng"step="any"></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="Submit" value="Add"></td>
			</tr>
		</table>
	</form>
</body>
</html>