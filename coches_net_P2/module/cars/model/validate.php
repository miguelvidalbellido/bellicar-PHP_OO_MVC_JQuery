<?php
    function validate_matricula($matricula){
        $sql = "SELECT * FROM cars WHERE car_plate='$matricula'";

        $conexion = connect::con();
        $res = mysqli_query($conexion,$sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function validate_licencia($licencia){
        $sql = "SELECT * FROM cars WHERE license_number='$licencia'";

        $conexion = connect::con();
        $res = mysqli_query($conexion,$sql)->fetch_object();
        connect::close($conexion);
        return $res;
    }

    function validate(){
        $check = true;

        $matricula = $_POST['matricula'];
        $licencia = $_POST['licencia'];
        
        $matricula = validate_matricula($matricula);
        $licencia = validate_licencia($licencia);
        
        if($matricula!=null){
            echo '<script language="javascript">setTimeout(() => {
                toastr.error("El número de matricula, ya se encuentra almacenado");
            }, 1000);</script>';

            $check = false;
        }

        if($licencia!=null){
            echo '<script language="javascript">setTimeout(() => {
                toastr.error("El número de licencia, ya se encuentra almacenado");
            }, 1000);</script>';

            $check = false;
        }

        return $check;
    }
?>