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

        function addToCartFromDetails($username, $cod_car, $quantity){
            $sql = "CALL addToCartDetails('$username', $cod_car, $quantity, @res);";

            $sql .= "SELECT @res AS 'resultado';";

            $conexion = connect::con();
            mysqli_multi_query($conexion, $sql);
            // Recorremos el retorno de mysql para comprobar si hay resultado hasta que lo encontramos y lo devolvemos con do-while
            $resultado = null;
            do {
                if ($result = mysqli_store_result($conexion)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultado = $row['resultado'];
                    }
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conexion));

            connect::close($conexion);

            return $resultado;
        }

        function loadCart($username){

            $sql = "SELECT tc.*, c.price, b.*, m.*, img.url_image
            FROM temporal_cart tc, car c, model m, brand b, image img
            WHERE tc.cod_car = c.cod_car AND m.cod_model = c.cod_model AND m.cod_brand = b.cod_brand AND img.chassis_number = c.chassis_number AND username LIKE '$username' AND img.url_image LIKE '%prtd-%' ;";
    
            $conexion = connect::con();
		    $res = mysqli_query($conexion, $sql);
		    connect::close($conexion);

            $return = array();
                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $row) {
                        array_push($return, $row);
                    }
                }
            return $return;
        }

        function modifyCart($cod_car, $username, $quantity){
            $sql = "CALL changeCart($cod_car, '$username', $quantity, @res);";

            $sql .= "SELECT @res AS 'resultado';";

            $conexion = connect::con();
            mysqli_multi_query($conexion, $sql);
            // Recorremos el retorno de mysql para comprobar si hay resultado hasta que lo encontramos y lo devolvemos con do-while
            $resultado = null;
            do {
                if ($result = mysqli_store_result($conexion)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultado = $row['resultado'];
                    }
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conexion));

            connect::close($conexion);

            return $resultado;
        }

        function removeProduct($username, $cod_car) {
            $sql = "DELETE FROM temporal_cart WHERE username LIKE '$username' AND cod_car = $cod_car";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            return $res;
        }

        function detailsCheckout($username){
            $sql = "SELECT SUM(tmp.total_unitario) AS 'total_carrito'
                    FROM (SELECT tc.quantity * c.price AS 'total_unitario'
                            FROM temporal_cart tc, car c
                            WHERE tc.cod_car = c.cod_car AND tc.username LIKE '$username') AS tmp";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql)->fetch_assoc();
            connect::close($conexion);

            return $res;
        }

        function checkout($username){
            $sql = "CALL checkout('$username', @res);";

            $sql .= "SELECT @res AS 'resultado';";
            $conexion = connect::con();
            mysqli_multi_query($conexion, $sql);
            // Recorremos el retorno de mysql para comprobar si hay resultado hasta que lo encontramos y lo devolvemos con do-while
            $resultado = null;
            do {
                if ($result = mysqli_store_result($conexion)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultado = $row['resultado'];
                    }
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conexion));

            connect::close($conexion);

            return $resultado;
        }
    }

?>