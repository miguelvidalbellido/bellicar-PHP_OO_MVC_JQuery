<?php
    // $path = $_SERVER['DOCUMENT_ROOT'] . 'C:\xampp\htdocs\MVC';
    include('C:\xampp\htdocs\coches_net_P2\model\connect.php');
    // include("model/connect.php");

    class DAOCars{
        // INSERT
        function insert_car($datos){
            
            //die('<script>console.log('.json_encode( $datos ) .');</script>');
            $licencia = $datos['licencia'];
            $marca = $datos['marca'];
            $modelo = $datos['modelo'];
            $matricula = $datos['matricula'];
            $km = $datos['km'];
            $categoria = $datos['categoria'];
            $tipo = $datos['tipo'];
            $comentarios = $datos['comentarios'];
            $alta = $datos['alta'];
            $color = $datos['color'];
            // foreach ($datos['extras[]'] as $indice) {
        	//     $extras=$extras."$indice:";
        	// }
            $extras = "";
            foreach($_POST['extras'] as $indice){
                $extras=$extras."$indice:";
            }
            // $extras = $datos['extras[]'];
            $imagen = $datos['imagen'];
            $precio = $datos['precio'];
            $puertas = "";
            foreach($_POST['puertas'] as $indice){
                $puertas=$puertas."$indice";
            }
            $ciudad = $datos['ciudad'];
            $latitud = $datos['latitud'];
            $longitud = $datos['longitud'];
            //die('<script>console.log('.json_encode( $datos ) .');</script>');
            $sql = "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)" . "VALUES('$licencia','$marca','$modelo','$matricula','$km','$categoria',
            '$tipo','$comentarios','$alta','$color','$extras','$imagen','$precio','$puertas','$ciudad','$latitud','$longitud')";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

         // UPDATE
         function update_car($datos){
            
            $licencia = $datos['licencia'];
            $marca = $datos['marca'];
            $modelo = $datos['modelo'];
            $matricula = $datos['matricula'];
            $km = $datos['km'];
            $categoria = $datos['categoria'];
            $tipo = $datos['tipo'];
            $comentarios = $datos['comentarios'];
            $alta = $datos['alta'];
            $color = $datos['color'];
            $extras = "";
            foreach($_POST['extras'] as $indice){
                $extras=$extras."$indice:";
            }
            $imagen = $datos['imagen'];
            $precio = $datos['precio'];
            $puertas = "";
            foreach($_POST['puertas'] as $indice){
                $puertas=$puertas."$indice";
            }
            $ciudad = $datos['ciudad'];
            $latitud = $datos['latitud'];
            $longitud = $datos['longitud'];
            //die('<script>console.log('.json_encode( $datos ) .');</script>');

            // $sql = "UPDATE car SET license_number='$licencia', brand='$marca', model='$modelo', car_plate='$matricula', km='$km', category='$categoria', type='$tipo', comments='$comentarios', discharge_date='$alta', color='$color', extras='$extras', car_image='$imagen',
            // price='$precio', doors='$puertas', city='$ciudad', lat='$latitud', lng='$longitud' WHERE id='173'";
            $sql = "UPDATE cars SET license_number='$licencia', brand='$marca', model='$modelo', km='$km', category='$categoria', type='$tipo', comments='$comentarios', discharge_date='$alta', color='$color', extras='$extras', car_image='$imagen',
            price='$precio', doors='$puertas', city='$ciudad', lat='$latitud', lng='$longitud' WHERE car_plate='$matricula'";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
        }

        // FUNCTIONS SELECT
        function select_all_car(){
            $sql = "SELECT * FROM cars ORDER BY id ASC";
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            //die('<script>console.log('.json_encode( $res->num_rows ) .');</script>');
            return $res;
        }

        function select_one_car($car){
            $sql = "SELECT * FROM cars WHERE id='$car'";
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_object();
            connect::close($conexion);
            return $res;
        }

        // FUNCTION DELETE
        function delete_car($id){
			$sql = "DELETE FROM cars WHERE id='$id'";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            return $res;
		}


        // DUMMIES //////////// 
        function dummies_cars(){
            $sql = "DELETE FROM cars;";

            $sql.= "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)"
            ."VALUES('1W2D50JIL04J3L5K1','BMW','I4','4567DAB','25600','Utilitario',
            'ET','Siempre garaje nunca circuito','2023-01-20','negro','Sensor aparcamiento:Cargador inalambrico:','imageni4','150000','4','Xativa','0.56','1.0');";

            $sql.= "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)"
            ."VALUES('2OUD50JIL04J3L5G6','Seat','Leon','2516TRF','25600','Utilitario',
            'HB','El rey de la discoteca','2010-01-20','amarillo','Sensor aparcamiento:Cargador inalambrico:','imagenleon','15000','4','Alzira','2.5','-1.0');";

            $sql.= "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)"
            ."VALUES('8P9D50JIL04J3L1H7','Porche','Panamera','8526DFG','22000','Compacto',
            'ET','Ruedas recien cambiadas','2021-01-20','rojo','Sensor aparcamiento','imagenpanamera','200000','5','Ontinyent','-0.56','1.0');";

            $sql.= "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)"
            ."VALUES('44GD50JIL04J3LH58','Range Rover','Pajero','7897PTR','1500','Utilitario',
            'ET','Coche km cero solo utilizado de muestra','2022-01-20','negro','Sensor aparcamiento:','imagenpajero','120000','5','Alcoy','3','1.0');";

            $sql.= "INSERT INTO cars(license_number,brand,model,car_plate,km,category,type,comments,discharge_date,color,extras,car_image,price,doors,city,lat,lng)"
            ."VALUES('3J4750JIL04J3LKP4','Opel','Astra','52458RFT','6005','Compacto',
            'GS','No sabe girar','2015-03-23','azul','Sensor aparcamiento','imagenopelsito','6500','5','Cocentaina','0.22','1.7');";

            $conexion = connect::con();
            $res = mysqli_multi_query($conexion, $sql);
            connect::close($conexion);

            return $res;
        }

        function delete_all_cars(){
			$sql = "DELETE FROM cars";
			
			$conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
		}
    }
?>