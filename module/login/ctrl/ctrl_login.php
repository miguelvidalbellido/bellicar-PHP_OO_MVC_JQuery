<?php

    include('C:\xampp\htdocs\coches_net\module\login\model\DAO_login.php');
    include('C:\xampp\htdocs\coches_net\model\middleware_auth.php');

    @session_start();

    switch ($_GET['op']) {

    case 'loginAndRegisterView':
        include("module/login/view/loginAndRegister.html");
        break;

    case 'register':
        // echo json_encode($_POST['f_nacimientoRegister']);
        // exit;
        try{
            $daoRegister = new DAOLogin();
            $rdo = $daoRegister -> registerUser($_POST['usernameRegister'],$_POST['emailRegister'],$_POST['passwordRegister'],$_POST['f_nacimientoRegister']);
        } catch (Exception $e){
            echo json_encode("error");
        }

        echo json_encode($rdo); // Devolvemos el resultado

        break;
    
    case 'login':
        // echo json_encode($_POST['passwordLogin']);
        try {
            $daoLogin = new DAOLogin();
            $rdo = $daoLogin -> loginUser($_POST['usernameLogin'],$_POST['passwordLogin']);
        } catch(Exception $e) {
            echo json_encode("error");
        }

        if($rdo == "error_username"){ 
            echo json_encode("error_username");
            exit;
        } else if(password_verify($_POST['passwordLogin'], $rdo)) {
            $token = create_token_refresh($_POST['usernameLogin']);
            $_SESSION['username'] = $_POST['usernameLogin'];
            $_SESSION['tiempo'] = time();
            $token_large = create_token($_POST['usernameLogin']);
            $output = [
                'token_large' => $token_large,
                'token_refresh' => $token,
            ];
            echo json_encode($output);
            exit;
        } else {
            echo json_encode("error_password");
            exit;
        }

        echo json_encode($rdo); // Devolvemos el resultado
        break;

    case 'logout':
        unset($_SESSION['username']);
        unset($_SESSION['tiempo']);
        session_destroy();

        echo json_encode('Done');
        break;
        
    case 'dataUser':
        $json = decode_token($_POST['token']);
        $daoLogin = new DAOLogin();
        $rdo = $daoLogin -> selectDataUser($json['username']);
        echo json_encode($rdo);
        exit;
        break;

    case 'controlUser':
        $parseToken = decode_token($_POST['token']);

        if($parseToken['exp'] < time()){
            echo json_encode("wrongUser");
            exit;
        }

        if(isset($_SESSION['username']) && ($_SESSION['username']) == $parseToken['username']){
            echo json_encode("correctUser");
            exit;
        } else {
            echo json_encode("wrongUser");
            exit;
        }
        break;

    case 'controlActivity':
        if (!isset($_SESSION["tiempo"])) {
            echo json_encode("inactivo");
            exit();
        } else {
            if ((time() - $_SESSION["tiempo"]) >= 1800) { //1800s=30min
                echo json_encode("inactivo");
                exit();
            } else {
                echo json_encode("activo");
                exit();
            }
        }
        break;

    case 'checkExpirationTokenRefresh':
        $tokenRefreshDec = decode_token($_POST['token_refresh']);
        $tokenLargeDec = decode_token($_POST['token_large']);

        
        // Comprobamos si Token Refresh ha caducado
        if ($tokenRefreshDec['exp'] < time()) {
            if ($tokenLargeDec['exp'] > time()) {
                // Devolvemos que hay que generar token nuevo
                echo json_encode("ExpiredJWTRefresh");
            } else {
                // Devolvemos que han caducado los dos y hay que hacer logout
                echo json_encode("ExpiredJWTToken");
            }
        } else {
            echo json_encode("NotExpiredJWTRefresh");
        }
        break;
    
    case 'changeTokenRefres':
        // Comprobamos que el usuario del token es el mismo que el de la session
        $parseToken = decode_token($_POST['token']);
        if(isset($_SESSION['username']) && ($_SESSION['username']) == $parseToken['username']){
            $token = create_token_refresh($_SESSION['username']);
            echo json_encode($token);
            exit;
        } else {
            echo json_encode("wrongUser");
            exit;
        }

        break;
    }

    

?>