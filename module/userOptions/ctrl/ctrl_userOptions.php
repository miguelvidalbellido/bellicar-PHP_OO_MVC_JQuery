<?php

    include('C:\xampp\htdocs\coches_net\module\userOptions\model\DAO_userOptions.php');
    @session_start();
    switch($_GET['op']){
        case 'launch':
            include("module/userOptions/view/userOptionst.html");
            exit;
            break;
    }

?>