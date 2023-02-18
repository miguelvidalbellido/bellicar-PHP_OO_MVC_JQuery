<?php
class connect{
    public static function con(){
        $host = 'localhost';  
        $user = "root";                     
        $pass = "";                             
        $db = "cars";                      
        $port = 3306;                           
        $tabla="cars";
        
        $conexion = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
        //die('<script>console.log('.json_encode( $conexion ) .');</script>');
        return $conexion;
    }
    public static function close($conexion){
        mysqli_close($conexion);
    }
}
?>