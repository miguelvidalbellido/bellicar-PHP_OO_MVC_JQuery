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
        $sql = "SELECT DISTINCT m.*
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

    function searchPopulations($arraysdata){
        $sql = "SELECT DISTINCT  kk.description_population
        FROM (SELECT  p.description 'description_population', b.description 'description_brand', m.description 'description_model'
            FROM car c, population p, model m, brand b
            WHERE c.zip_code = p.zip_code AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand) kk";
        
        for ($i=0; $i < count($arraysdata); $i++){
            $i==0 ? $sql.= " WHERE kk." . $arraysdata[$i][0] . " LIKE '" . $arraysdata[$i][1]. "%'" : $sql.= " AND kk." . $arraysdata[$i][0] . " LIKE '" . $arraysdata[$i][1] . "'";
        }

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