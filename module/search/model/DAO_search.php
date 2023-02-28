<?php

include('C:\xampp\htdocs\coches_net\model\connect.php');

class DAOSearch {
    function searchBrands(){
        $sql = "SELECT * FROM brand";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $resArray = array();
        if($res -> num_rows > 0){
            while($row = mysqli_fetch_array($res)){
                $resArray[] = $row;
            }
        }
        return $resArray;
    }

    function searchAllModels(){
        $sql = "SELECT * FROM model";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $resArray = array();
        if($res -> num_rows > 0){
            while($row = mysqli_fetch_array($res)){
                $resArray[] = $row;
            }
        }
        return $resArray;
    }

    function searchModelsBrand($brandFilter){
        $sql = "SELECT m.*
        FROM model m, brand b
        WHERE m.cod_brand = b.cod_brand AND b.description LIKE '$brandFilter'";
        
        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $resArray = array();
        if($res -> num_rows > 0){
            while($row = mysqli_fetch_array($res)){
                $resArray[] = $row;
            }
        }
        return $resArray;
    }
}

?>