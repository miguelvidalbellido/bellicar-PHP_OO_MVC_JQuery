<?php

    include('C:\xampp\htdocs\coches_net\module\login\model\DAO_login.php');

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
            echo json_encode("login_ok");
            exit;
        } else {
            echo json_encode("error_password");
            exit;
        }

        echo json_encode($rdo); // Devolvemos el resultado
        break;
    }
?>