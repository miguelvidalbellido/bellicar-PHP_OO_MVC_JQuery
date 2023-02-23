<?php

    include('C:\xampp\htdocs\coches_net\module\shop\model\DAO_shop.php');

    switch($_GET['op']){
        
        case 'list';
            include("module/shop/view/shop.html");
            exit;
            break;

        case 'all_cars';
            try{
                $daoshop = new DAOShop();
                $SelectAllCars = $daoshop->select_cars();
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
            $selSlide = $homeQuery -> filters($_POST['filter']);

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
            $selSlide = $homeQuery -> filters($filterWithToken[1]);// [0] - TOKEN [1] - FILTROS

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
    }

?>