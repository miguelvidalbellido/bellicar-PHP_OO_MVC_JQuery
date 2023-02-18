<?php

include_once("connect.php");

if(isset($_POST['update'])){
    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
    // Recogemos los datos que hemos recibido por POST y los asignamos a variables
    $id = mysqli_real_escape_string($mysqli,$_POST['id']);
    $license_number = mysqli_real_escape_string($mysqli,$_POST['license_number']);
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

    // Comprobamos que no hayan campos vacios
    if(empty($id) || empty($license_number) || empty($brand) || empty($model) || empty($car_plate) ||
    empty($km) ||empty($category) || empty($type) || empty($comments) || empty($discharge_date) ||
    empty($color) || empty($extras) || empty($car_image) || empty($price) || empty($doors) || empty($city) || empty($lat) || empty($lng)){
        
        // Avisamos de los campos vacios
        if(empty($id)){
            echo "<font color='red'>Id se encuentra vacio.</font><br/>";
        }
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
        // Actualizamos el registro en la BD
        $result = mysqli_query($mysqli, "UPDATE cars SET license_number='$license_number',brand='$brand',model='$model',car_plate='$car_plate',km='$km',category='$category',
        type='$type',comments='$comments',discharge_date='$discharge_date',color='$color',extras='$extras',car_image='$car_image',price='$price',doors='$doors',city='$city',lat='$lat',lng='$lng' WHERE id=$id");

        header("Location: index.php");
    }
    
}
?>

<?php

// Obtenemos el ID mediante GET
$id = $_GET['id'];
// Obtenemos la información relacionada con el ID obtenido
$result = mysqli_query($mysqli, "SELECT * FROM cars WHERE id=$id");
while($res = mysqli_fetch_array($result)){
    $license_number = $res['license_number'];
    $brand = $res['brand'];
    $model = $res['model'];
    $car_plate = $res['car_plate'];
    $km = $res['km'];
    $category = $res['category'];
    $type = $res['type'];
    $comments = $res['comments'];
    $discharge_date = $res['discharge_date'];
    $color = $res['color'];
    $extras = $res['extras'];
    $car_image = $res['car_image'];
    $price = $res['price'];
    $doors = $res['doors'];
    $city = $res['city'];
    $lat = $res['lat'];
    $lng = $res['lng'];

}
?>

<html>
<head>	
	<title>Editar</title>
</head>

<body>
	<a href="index.php">Principal</a>
	<br/><br/>
	
	<form name="form1" method="post" action="update.php">
		<table border="0">
			<tr> 
				<td>License_number</td>
				<td><input type="text" name="license_number" value="<?php echo $license_number;?>"></td>
			</tr>
			<tr> 
				<td>Brand</td>
				<td><input type="text" name="brand" value="<?php echo $brand;?>"></td>
			</tr>
			<tr> 
				<td>Model</td>
				<td><input type="text" name="model" value="<?php echo $model;?>"></td>
			</tr>
            <tr> 
				<td>car_plate</td>
				<td><input type="text" name="car_plate" value="<?php echo $car_plate;?>"></td>
			</tr>
            <tr> 
				<td>km</td>
				<td><input type="text" name="km" value="<?php echo $km;?>"></td>
			</tr>
            <tr> 
				<td>category</td>
				<td><input type="text" name="category" value="<?php echo $category;?>"></td>
			</tr>
            <tr> 
				<td>type</td>
				<td><input type="text" name="type" value="<?php echo $type;?>"></td>
			</tr>
            <tr> 
				<td>comments</td>
				<td><input type="text" name="comments" value="<?php echo $comments;?>"></td>
			</tr>
            <tr> 
				<td>discharge_date</td>
				<td><input type="text" name="discharge_date" value="<?php echo $discharge_date;?>"></td>
			</tr>
            <tr> 
				<td>color</td>
				<td><input type="text" name="color" value="<?php echo $color;?>"></td>
			</tr>
            <tr> 
				<td>extras</td>
				<td><input type="text" name="extras" value="<?php echo $extras;?>"></td>
			</tr><tr> 
				<td>car_image</td>
				<td><input type="text" name="car_image" value="<?php echo $car_image;?>"></td>
			</tr>
            <tr> 
				<td>price</td>
				<td><input type="text" name="price" value="<?php echo $price;?>"></td>
			</tr>
            <tr> 
				<td>doors</td>
				<td><input type="text" name="doors" value="<?php echo $doors;?>"></td>
			</tr>
            <tr> 
				<td>city</td>
				<td><input type="text" name="city" value="<?php echo $city;?>"></td>
			</tr>
            <tr> 
				<td>lat</td>
				<td><input type="text" name="lat" value="<?php echo $lat;?>"></td>
			</tr>
            <tr> 
				<td>lng</td>
				<td><input type="text" name="lng" value="<?php echo $lng;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>