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
            $sql = "SELECT *, (SELECT COUNT(*) FROM historyfilters WHERE token_guest LIKE '_$user%') AS 'num_searchs'
            FROM users 
            WHERE username LIKE '$user' ";
        
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

    function cantSearchs(){
        $sql = "SELECT COUNT(*) AS 'cantSearchs' FROM historyfilters WHERE dateSearch = CURDATE(); ";

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql)->fetch_array();
        connect::close($conexion);
        return $res;
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

    function createUser($username, $email, $passwd, $f_birth) {

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

    // STATS

    function brandMoreVisited() {
        $sql = "SELECT b.description, SUM(v.num_visits) AS 'num_visits'
        FROM car c, model m, brand b, visits v
        WHERE c.cod_model = m.cod_model AND m.cod_brand = b.cod_brand AND v.cod_car = c.cod_car
        GROUP BY b.description
        ORDER BY v.num_visits DESC";

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

    function userDateRegister() {
        $sql = "SELECT u.d_registration, COUNT(u.id_user) AS 'quantity_register'
        FROM users u 
        GROUP BY u.d_registration ASC";

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

    function bodyworkMoreVisited() {
        $sql = "SELECT b.description, SUM(v.num_visits) AS 'num_visitas'
        FROM car c, bodywork b, visits v
        WHERE c.cod_bodywork = b.cod_bodywork AND v.cod_car = c.cod_car
        GROUP BY b.cod_bodywork";

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