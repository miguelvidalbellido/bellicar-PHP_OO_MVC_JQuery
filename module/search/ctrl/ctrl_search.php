<?php
    
    include('C:\xampp\htdocs\coches_net\module\search\model\DAO_search.php');

    switch($_GET['op']){

        case 'searchBrands';
            $queryBrand = new DAOSearch();
            $resQueryBrand = $queryBrand -> searchBrands();

            if(!empty($resQueryBrand)){
                echo json_encode($resQueryBrand);
            }else{
                echo json_encode("error");
            }
            exit;
        break;

        case 'searchAllModel';
            $queryAllModels = new DAOSearch();
            $resQueryAllModels = $queryAllModels -> searchAllModels();

            if(!empty($resQueryAllModels)){
                echo json_encode($resQueryAllModels);
            }else{
                echo json_encode("error");
            }
            exit;
        break;

        case 'searchModelsBrand';
            $queryModelsBrand = new DAOSearch();
            $resQueryModelsBrand = $queryModelsBrand -> searchModelsBrand($_POST['brand']);

            if(!empty($resQueryModelsBrand)){
                echo json_encode($resQueryModelsBrand);
            }else{
                echo json_encode("error");
            }
            exit;
        break;

        
    }
?>