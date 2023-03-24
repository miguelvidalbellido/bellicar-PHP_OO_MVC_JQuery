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
    }
?>