<?php
class connect{
    public static function con(){
        $credentials = parse_ini_file('C:\xampp\htdocs\coches_net\model\data.ini', true);

        $conexion = mysqli_connect($credentials['db_credentials']['host'], $credentials['db_credentials']['user'], $credentials['db_credentials']['pass'], $credentials['db_credentials']['db'], $credentials['db_credentials']['port'])or die(mysql_error());
        //die('<script>console.log('.json_encode( $conexion ) .');</script>');
        return $conexion;
    }
    public static function close($conexion){
        mysqli_close($conexion);
    }
}
?>