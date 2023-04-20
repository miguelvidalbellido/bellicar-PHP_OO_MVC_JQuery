<?php
    include('C:\xampp\htdocs\coches_net\module\shopCart\model\DAO_shopCart.php');
    @session_start();

    switch($_GET['op']){
        case 'list':
            include ('module/shopCart/view/shopCart.html');
            break;
        
        case 'checkStock':
            $checkStock = new DAOshopCart;
            $quantityStock = $checkStock -> checkStock($_POST['id_car']);

            if (!empty($quantityStock)) {
                echo json_encode($quantityStock);
            }
            else {
                echo json_encode("error");
            }
            exit;
        break;
    }
?>