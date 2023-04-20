<?php

    include('C:\xampp\htdocs\coches_net\model\connect.php');
    
    class DAOshopCart{
        function checkStock($id_car){
            $sql = "SELECT quantity FROM stock WHERE id_car = $id_car";

            $conexion = connect::con();
		    $res = mysqli_query($conexion, $sql)->fetch_object();
		    connect::close($conexion);

		    return $res;
        }
    }

?>