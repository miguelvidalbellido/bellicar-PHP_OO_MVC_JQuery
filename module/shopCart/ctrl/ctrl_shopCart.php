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
                echo json_encode("error ctrl checkStock");
            }
            exit;
        break;

        case 'addToCartFromDetails':
            
            $addCart = new DAOshopCart;
            $resultAddCart = $addCart ->addToCartFromDetails($_POST['username'], $_POST['cod_car'], $_POST['quantity']);

            if(!empty($resultAddCart)){
                echo json_encode($resultAddCart);
            }else {
                echo json_encode("error ctrl addToCartFromDetails");
            }
        break;

        case 'loadCart':
            $loadCart = new DAOshopCart;
            $resultLoadCart = $loadCart -> loadCart($_POST['username']);

            if(!empty($resultLoadCart)){
                echo json_encode($resultLoadCart);
            }else {
                echo json_encode("error ctrl loadCart");
            }
        break;

        case 'changeCart':
            $modifyCart = new DAOshopCart;
            $resultChangeCart = $modifyCart ->modifyCart($_POST['cod_car'],$_POST['username'], $_POST['quantity']);

            if(!empty($resultChangeCart)){
                echo json_encode($resultChangeCart);
            }else {
                echo json_encode("error ctrl changeCart");
            }
        break;

        case 'removeProduct':
            $deleteProduct = new DAOshopCart;
            $resultDeleteProduct = $deleteProduct ->removeProduct($_POST['username'],$_POST['cod_car']);

            if(!empty($resultDeleteProduct)){
                echo json_encode($resultDeleteProduct);
            }else {
                echo json_encode("error ctrl DeleteProduct");
            }

        break;
        
        case 'loadDetailsCheckout':
            $checkoutDetails = new DAOshopCart;
            $resultCheckoutDetails = $checkoutDetails ->detailsCheckout($_POST['username']);

            if(!empty($resultCheckoutDetails)){
                echo json_encode($resultCheckoutDetails);
            }else {
                echo json_encode("error ctrl DeleteProduct");
            }
        break;

        case 'checkout':
            $checkout = new DAOshopCart;
            $resultCheckout = $checkout ->checkout($_POST['username']);

            if(!empty($resultCheckout)){
                echo json_encode($resultCheckout);
            }else {
                echo json_encode("error ctrl resultCheckout");
            }
        break;

    }
?>