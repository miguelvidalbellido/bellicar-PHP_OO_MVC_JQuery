<?php

    include('C:\xampp\htdocs\coches_net\module\home\model\DAO_home.php');

    switch($_GET['op']){
        case 'list';
            include ('module/home/view/home.html');
        break;

        case 'homePageCategory';
            try{
                $daohome = new DAOHome();
                $SelectCategory = $daohome->select_categories();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectCategory)){
                echo json_encode($SelectCategory); 
            }
            else{
                echo json_encode("error");
            }
            exit;
        break;

        case 'homePageFuel';
            try{
                $daohome1 = new DAOHome();
                $SelectMotor = $daohome1->select_motors();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectMotor)){
                echo json_encode($SelectMotor); 
            }
            else{
                echo json_encode("error");
            }
            exit;
        break;
        

        case 'homePageBrands';
            try{
                $daohome2 = new DAOHome();
                $SelectBrands = $daohome2->select_brands();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectBrands)){
                echo json_encode($SelectBrands); 
            }
            else{
                echo json_encode("error");
            }
            exit;
        break;
    }


?>