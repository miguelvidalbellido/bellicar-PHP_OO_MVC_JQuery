<?php

    include('C:\xampp\htdocs\coches_net\model\connect.php');

    class DAOHome{

        function select_motors(){  
            $sql = "SELECT * FROM `type_motor`";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_brands(){  
            $sql = "SELECT * FROM `brand`";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_categories(){  
            $sql = "SELECT * FROM `bodywork`";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }   
        
        function selectCarsMoreVisit(){
            $sql = "SELECT DISTINCT m.description, v.num_visits, i.url_image
            FROM model m, car c, visits v, image i
            WHERE m.cod_model = c.cod_model AND c.cod_car = v.cod_car AND i.chassis_number = c.chassis_number AND i.url_image LIKE '%/prtd-%'
            GROUP BY m.cod_model
            ORDER BY 2 DESC
            LIMIT 5";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

    }

   

?>