<?php

    // $path = $_SERVER['DOCUMENT_ROOT'] . 'C:\xampp\htdocs\MVC';
    include('C:\xampp\htdocs\coches_net\module\cars\model\DAOCars.php');
    //include ("module/cars/model/DAOCars.php");
    //session_start();
    switch($_GET['op']){
        
        case 'list';
            try{
                // Creamos un objeto de tipo DAOcars y llamamos al metodo para obtener todos los coches de la BD
                $daocar = new DAOCars();
                $rdo = $daocar->select_all_car();
                //die('<script>console.log("'.$rdo->num_rows.'");</script>');
            }catch (Exception $e){
                // Almacenamos en $callback la direccion donde acceder y la llamamos desde el die
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }

            // Comprobamos que $rdo no este vacia
            if(!$rdo){
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                include("module/cars/view/list_cars.php");
            }
            break;

        case 'create';
        // Encapsulamos para evitar errores al cargar la página por primera vez !!!!!!!!!!!! PREGUNTAR YOLANDA
        
        include ("module/cars/model/validate.php");
        
        $check = true;
        
        if($_POST){
            // Llamos a la funcion "validate"[validate.php] que hemos importado para comprobar que se cumplen todos los parametros
            $check=validate(); 

            if($check){
                $_SESSION['alta_car']=$_POST;
                
                try{
                    $daocar = new DAOCars();
                    $rdo = $daocar->insert_car($_POST);
                }catch (Exception $e){
                    //die('<script>console.log('.json_encode( $daocar ) .');</script>');
                    $callback = 'index.php?page=503';
        			die('<script>window.location.href="'.$callback .'";</script>');
                }

                if($rdo){
                    echo '<script language="javascript">setTimeout(() => {
                        toastr.error("Añadido en la base de datos correctamente");
                    }, 1000);</script>';
                    $callback = 'index.php?page=controller_cars&op=list';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }else{
                    $callback = 'index.php?page=503';
                    die('<script>window.location.href="'.$callback .'";</script>');
                }
            }
        }
        include ("module/cars/view/create_car.php");
        break;

        case 'update';
            //include ("module/cars/model/validate.php");
            $check = true;
            
            if($_POST){
                // Llamos a la funcion "validate"[validate.php] que hemos importado para comprobar que se cumplen todos los parametros
                //$check=validate(); ELIMINAMOS LA VALIDACION PHP DE MOMENTO
                //die('<script>console.log('.json_encode( "dasds" ) .');</script>');
                if($check){
                    $_SESSION['car']=$_POST;
                    try{
                        
                        $daocar = new DAOCars();
                        $rdo = $daocar->update_car($_POST);
                    }catch (Exception $e){
                        // die('<script>console.log('.json_encode( "dasds" ) .');</script>');
                        $callback = 'index.php?page=503';
                        die('<script>window.location.href="'.$callback .'";</script>');
                    }

                    if($rdo){
                        echo '<script language="javascript">setTimeout(() => {
                            toastr.error("Actualizado en la base de datos correctamente");
                        }, 1000);</script>';
                        $callback = 'index.php?page=controller_cars&op=list';
                        die('<script>window.location.href="'.$callback .'";</script>');
                    }else{
                        $callback = 'index.php?page=503';
                        die('<script>window.location.href="'.$callback .'";</script>');
                    }
                }
            }

            try{
                $daouser = new DAOCars();
            	$rdo = $daouser->select_one_car($_GET['id']);
            	$car=get_object_vars($rdo);
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
        	    include("module/cars/view/update_car.php");
    		}
        break;
            
        case 'read';
            try{
                // Creamos un objeto de tipo DAOcars y llamamos al metodo para obtener la información de x coche
                $daocar = new DAOCars();
                $rdo = $daocar->select_one_car($_GET['id']);
                $car = get_object_vars($rdo);
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            // Comprobamos que $rdo no este vacia
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
                include("module/cars/view/read_car.php");
    		}
            break;

        case 'delete';
            // Comprobamos que la vairable $_POST['delete'] este definida y no sea null
            if ($_POST){
                try{
                    $daocar = new DAOCars();
                    //die('<script>console.log('.json_encode( $_POST ) .');</script>');
                	$rdo = $daocar->delete_car($_POST['id']);
                }catch (Exception $e){
                    $callback = 'index.php?page=503';
    			    die('<script>window.location.href="'.$callback .'";</script>');
                }
            	
            	if($rdo){
        			echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
        			$callback = 'index.php?page=controller_cars&op=list';
    			    die('<script>window.location.href="'.$callback .'";</script>');
        		}else{
        			$callback = 'index.php?page=503';
			        die('<script>window.location.href="'.$callback .'";</script>');
        		}
            }
            
            try{
                $daouser = new DAOCars();
            	$rdo = $daouser->select_one_car($_GET['id']);
            	$car=get_object_vars($rdo);
            }catch (Exception $e){
                $callback = 'index.php?page=503';
			    die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if(!$rdo){
    			$callback = 'index.php?page=503';
    			die('<script>window.location.href="'.$callback .'";</script>');
    		}else{
        	    include("module/cars/view/delete_car.php");
    		}

            
            break;

        // DUMMIES //////////////////
        case 'dummies';
        if ($_POST){
            try{
                $dao_cars = new DAOCars();
                $result = $dao_cars->dummies_cars();
            }catch (Exception $e){
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }

            if($result){
                echo '<script language="javascript">alert("Lista de coches creada correctamente")</script>';
                $callback = 'index.php?page=controller_cars&op=list';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                // die('<script>console.log('.json_encode( "ERROR 2" ) .');</script>');
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
        
        include("module/cars/view/dummies_cars.php");
        break;

        case 'delete_all';
        //echo'<script>console.log('.json_encode( $_POST ) .');</script>';
        if ($_POST){
            
            try{
                $dao_cars = new DAOCars();
                $result = $dao_cars -> delete_all_cars();
            }catch (Exception $e){
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
            
            if($result){
                echo '<script language="javascript">alert("Borrado en la base de datos correctamente")</script>';
                $callback = 'index.php?page=controller_cars&op=list';
                die('<script>window.location.href="'.$callback .'";</script>');
            }else{
                $callback = 'index.php?page=503';
                die('<script>window.location.href="'.$callback .'";</script>');
            }
        }
        
        include("Module/cars/view/delete_all_cars.php");
        break;

        case 'read_modal':
            //echo $_GET["modal"]; 
            //exit;

            try{
                $daocar = new DAOCars();
            	$rdo = $daocar->select_one_car($_GET['modal']);
            }catch (Exception $e){
                echo json_encode("error");
                exit;
            }
            if(!$rdo){
    			echo json_encode("error");
                exit;
    		}else{
    		    $car=get_object_vars($rdo);
                echo json_encode($car);
                //echo json_encode("error");
                exit;
    		}
            break;

        default;
            include("view/inc/error404.php");
            break;
    }
?>