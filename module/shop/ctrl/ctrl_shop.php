<?php

    include('C:\xampp\htdocs\coches_net\module\shop\model\DAO_shop.php');
    @session_start();
    switch($_GET['op']){
        
        case 'list';
            include("module/shop/view/shop.html");
            exit;
            break;

        case 'all_cars';
            try{
                $daoshop = new DAOShop();
                $SelectAllCars = $daoshop->select_cars($_POST['total_prod'],$_POST['items_page']);
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectAllCars)){
                echo json_encode($SelectAllCars); 
            }
            else{
                echo json_encode("error");
            }
            exit;
            break;
        
            case 'count_all_cars';
            try{
                $daoshop = new DAOShop();
                $SelectAllCars = $daoshop->count_all_cars();
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectAllCars)){
                echo json_encode($SelectAllCars); 
            }
            else{
                echo json_encode("error");
            }
            exit;
            break;

            case 'count_cars_filter';
            // $test = $_POST['filter'];
            // echo json_encode($test);
            try{
                $daoshop = new DAOShop();
                $SelectAllCars = $daoshop->count_filters($_POST['filter']);
            } catch(Exception $e){
                echo json_encode("error");
            }
            
            if(!empty($SelectAllCars)){
                echo json_encode($SelectAllCars); 
            }
            else{
                echo json_encode("error");
            }
            exit;
            break;
        
        case 'details_car':
            // Check if exists in table visits
            $daoifexists = new DAOShop();
            $existsInVisits = $daoifexists -> checkIfExistsInVisits($_GET['id']);

            try {
                $daoshop = new DAOShop();
                $Date_car = $daoshop->select_one_car($_GET['id']);
            } catch (Exception $e) {
                echo json_encode("error");
            }
            try {
                $daoshop_img = new DAOShop();
                $Date_images = $daoshop_img->select_imgs_car($_GET['id']);
            } catch (Exception $e) {
                echo json_encode("error");
            }
    
            if (!empty($Date_car || $Date_images)) {
                $rdo = array();
                $rdo[0] = $Date_car;
                $rdo[1][] = $Date_images;
                
                echo json_encode($rdo);
            } else {
                echo json_encode("error");
            }
            exit;
        break;

        case 'lateral_menu':
            try {
                $daoshopFuel = new DAOShop();
                $dateFuel = $daoshopFuel->search_fuel();
            } catch (Exception $e) {
                echo json_encode("error");
            }

            try {
                $daoshopBrand = new DAOShop();
                $dateBrand = $daoshopBrand->search_brands();
            } catch (Exception $e) {
                echo json_encode("error");
            }

            try {
                $daoshopShifter = new DAOShop();
                $dateShifter = $daoshopShifter->search_shifter();
            } catch (Exception $e) {
                echo json_encode("error");
            }

            try {
                $daoshopProvince = new DAOShop();
                $dateProvince = $daoshopProvince->search_environmental_label();
            } catch (Exception $e) {
                echo json_encode("error");
            }
    
            if (!empty($dateFuel || $dateBrand || $dateShifter || $dateProvince)) {
                $rdo = array();
                $rdo[0] = $dateFuel;
                $rdo[1][] = $dateBrand;
                $rdo[2][] = $dateShifter;
                $rdo[3][] = $dateProvince;
                
                echo json_encode($rdo);
            } else {
                echo json_encode("error");
            }
            exit;
        break;

        case 'filter':
            $homeQuery = new DAOShop;
            $selSlide = $homeQuery -> filters($_POST['filter'],$_POST['total_prod'],$_POST['items_page']);

            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo json_encode("error");
            }
        break;

        case 'filters_token':
            $filterWithToken = $_POST['filter'];
            $saveQuery = new DAOShop;
            $query = $saveQuery -> saveFilters($filterWithToken);

            $homeQuery = new DAOShop;
            $selSlide = $homeQuery -> filters($filterWithToken[1],$_POST['total_prod'],$_POST['items_page']);// [0] - TOKEN [1] - FILTROS

            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo json_encode("error");
            }
        break;

        case 'seeLastFilters':
            $homeQuery = new DAOShop;
            $selSlide = $homeQuery -> seeLastFilters($_POST['token']);

            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo json_encode("error");
            }
        break;

        case 'loadSimilarCars':
            $homeQuery = new DAOShop;
            $selSlide = $homeQuery -> similarCars($_POST['id']);

            if (!empty($selSlide)) {
                echo json_encode($selSlide);
            }
            else {
                echo json_encode("error");
            }
            // echo json_encode($_POST['id']);
            break;
        
        case 'likes':
                try{
                    $daoShop = new DAOShop();
                    $checkLike = $daoShop->checkLikes($_POST['token'],$_POST['cod_car']);
                } catch(Exception $e){
                    echo json_encode("error");
                }
                
                if(!empty($checkLike)){
                    echo json_encode($checkLike); 
                }
                else{
                    echo json_encode("error");
                }
            break;

        case 'likesUser':
                try{
                    $daoShop = new DAOShop();
                    $checkLike = $daoShop->likesUser($_POST['token']);
                } catch(Exception $e){
                    echo json_encode("error");
                }
                
                if(!empty($checkLike)){
                    echo json_encode($checkLike); 
                }
                else{
                    echo json_encode("error");
                }
            break;

    }

    

?>