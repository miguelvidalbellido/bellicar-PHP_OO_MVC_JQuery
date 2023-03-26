<?php

    include('C:\xampp\htdocs\coches_net\model\connect.php');
    
    class DAOLogin{

        function registerUser($username, $email, $passwd, $f_birth) {

            $hashed_pass = password_hash($passwd, PASSWORD_DEFAULT, ['cost' => 12]);
            $hashavatar = md5(strtolower(trim($email))); 
            $avatar = "https://i.pravatar.cc/500?u=$hashavatar";
            $sql = "CALL registerUser('".$username."','".$hashed_pass."','".$f_birth."','".$email."','".$avatar."',@res);";
            $sql .= " SELECT @res AS resultado;";

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


        function loginUser($username, $passwd) {
            $hashed_pass = password_hash($passwd, PASSWORD_DEFAULT, ['cost' => 12]);

            $sql = "CALL loginUserSinPassword('".$username."','".$hashed_pass."',@res);";
            $sql .= "SELECT @res AS resultado;";

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