<?php

include('C:\xampp\htdocs\coches_net\module\dashboard\model\DAO_dashboard.php');
    @session_start();

    switch ($_GET['op']) {

    case 'launchView':
        include("module/dashboard/view/dashboard.html");
        break;
    
    // CRUD USERS

    case 'dataUsers':
        try{
            $daoDashboard = new DAODashboard();
            $SelectUsers = $daoDashboard->readUsers();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($SelectUsers)){
            echo json_encode($SelectUsers); 
        }
        else{
            echo json_encode("error");
        }
        exit;

    case 'deleteUser':
        try{
            $daoDashboard = new DAODashboard();
            $DeleteUser = $daoDashboard->deleteUser($_POST['username']);
        }catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($DeleteUser)){
            echo json_encode($DeleteUser); 
        }
        else{
            echo json_encode("error");
        }

        break;
    
    case 'dataOneUser':
        try{
            $daoDashboard = new DAODashboard();
            $SelectUsers = $daoDashboard->readOneUser($_POST['username']);
        } catch(Exception $e){
            echo json_encode("error");
        }
            
        if(!empty($SelectUsers)){
            echo json_encode($SelectUsers); 
        }
        else{
            echo json_encode("error");
        }
        exit;

    case 'updateUser':
        try{
            $daoDashboard = new DAODashboard();
            $existeUser = $daoDashboard->checkUsernameUpdate($_POST['usernameRegister'], $_POST['usernameRegisterDb']);
        } catch(Exception $e){
            echo json_encode("error");
        }

        if($existeUser->existe == 1){
            echo json_encode("Username_no_valido");
            exit;
        }

        // Si no existe el usuario comprueba el correo
        try{
            $daoDashboard1 = new DAODashboard();
            $existeMail = $daoDashboard1->checkEmailUpdate($_POST['emailRegister'], $_POST['emailRegisterDb']);
        } catch(Exception $e){
            echo json_encode("error");
        }

        if($existeMail->existe_mail == 1){
            echo json_encode("Email_no_valido");
            exit;
        }

        // Comprobamos si la passwd ha sido modificada

        if($_POST['passwordRegisterDb'] == $_POST['passwordRegister']){
            $password = $_POST['passwordRegisterDb'];
        }else {
            $password = password_hash($_POST['passwordRegister'], PASSWORD_DEFAULT, ['cost' => 12]);
        }

        try{
            $daoDashboard1 = new DAODashboard();
            $existeMail = $daoDashboard1->updateUser($_POST['usernameRegisterDb'], $_POST['usernameRegister'], $_POST['emailRegister'], $password, $_POST['f_nacimientoRegister']);
        } catch(Exception $e){
            echo json_encode("error");
        }

       echo json_encode($existeMail);


        // if(!empty($existeUser)){
        //     echo json_encode($existeUser); 
        // }
        // else{
        //     echo json_encode("error");
        // }

        break;
    case 'createUser':
            // echo json_encode($_POST['f_nacimientoRegister']);
            // exit;
            try{
                $daoRegister = new DAODashboard();
                $rdo = $daoRegister -> createUser($_POST['usernameRegister'],$_POST['emailRegister'],$_POST['passwordRegister'],$_POST['f_nacimientoRegister']);
            } catch (Exception $e){
                echo json_encode("error");
            }
    
            echo json_encode($rdo); // Devolvemos el resultado
    
            break;
    // ESTADISTICAS USERS

    case 'cantUsers':
        try{
            $daoDashboard = new DAODashboard();
            $countUsers = $daoDashboard->cantUsers();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($countUsers)){
            echo json_encode($countUsers); 
        }
        else{
            echo json_encode("error");
        }
        exit;
    
    case 'cantBusquedasDiarias':
        try{
            $daoDashboard = new DAODashboard();
            $countSearchs = $daoDashboard->cantSearchs();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($countSearchs)){
            echo json_encode($countSearchs); 
        }
        else{
            echo json_encode("error");
        }
        break;
    // STATS GENERALES

    case 'chartBrandMostVisited':
        try{
            $daoDashboard = new DAODashboard();
            $brandVisits = $daoDashboard->brandMoreVisited();
        } catch(Exception $e){
            echo json_encode("error");
        }

        if(!empty($brandVisits)){
            echo json_encode($brandVisits); 
        }
        else{
            echo json_encode("error");
        }
        break;

    case 'chartUserRegistration':
        try{
            $daoDashboard = new DAODashboard();
            $userRegistration = $daoDashboard->userDateRegister();
        } catch(Exception $e){
            echo json_encode("error");
        }
    
        if(!empty($userRegistration)){
            echo json_encode($userRegistration); 
        }
        else{
            echo json_encode("error");
        }
        break;

    case 'chartBodyworkMostVisited':
        try{
            $daoDashboard = new DAODashboard();
            $bodyworkVisits = $daoDashboard->bodyworkMoreVisited();
        } catch(Exception $e){
            echo json_encode("error");
        }
    
        if(!empty($bodyworkVisits)){
            echo json_encode($bodyworkVisits); 
        }
        else{
            echo json_encode("error");
        }
        break;
    
    case 'chartFuelMostVisited':
        try{
            $daoDashboard = new DAODashboard();
            $fuelVisits = $daoDashboard->fuelMoreVisited();
        } catch(Exception $e){
            echo json_encode("error");
        }
        
        if(!empty($fuelVisits)){
            echo json_encode($fuelVisits); 
        }
        else{
            echo json_encode("error");
        }
        break;
    }


    

    
?>