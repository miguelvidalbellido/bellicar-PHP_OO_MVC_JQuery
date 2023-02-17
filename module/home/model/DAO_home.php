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
        

    }

   

?>