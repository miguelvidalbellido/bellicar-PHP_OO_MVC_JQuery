<?php

    include('C:\xampp\htdocs\coches_net\model\connect.php');
    
    class DAODashboard{
        
        function readUsers(){
            $sql = "SELECT * FROM users";
        
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
    
        function readOneUser($user){
            $sql = "SELECT * FROM users WHERE username LIKE '$user'";
        
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

    function deleteUser($user) {
        $sql = "DELETE FROM users WHERE username LIKE '$user'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        return $res;
    }

    function cantUsers() {
        $sql = "SELECT COUNT(*) AS 'cantUsers' FROM users";

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

    function checkUsernameUpdate($username_new, $username_old){
        $sql = "SELECT COUNT(*) AS 'existe' FROM users WHERE username LIKE '$username_new' AND username NOT LIKE '$username_old'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function checkEmailUpdate($email_new, $email_old){
        $sql = "SELECT COUNT(*) AS 'existe_mail' FROM users WHERE email LIKE '$email_new' AND email NOT LIKE '$email_old'";
        // $sql = "SELECT COUNT(*) AS 'existe' FROM users WHERE email LIKE 'benito@gmail.com' AND email NOT LIKE 'miguel@gmail.com'";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function updateUser($username_old, $username_new, $email , $password, $d_birth){
        $sql = "UPDATE users u SET u.username = '$username_new', u.password = '$password', u.email = '$email', u.d_birth = $d_birth WHERE u.username = '$username_old'; ";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);
        return $res;
    }

    }
?>