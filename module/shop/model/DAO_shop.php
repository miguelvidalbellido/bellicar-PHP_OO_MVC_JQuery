<?php
    include('C:\xampp\htdocs\coches_net\model\connect.php');

    class DAOShop{

        function select_cars($limit, $offset){  
            $sql = "SELECT c.cod_car, YEAR(c.enrollment_date) AS 'year', c.km, c.publication_date, c.color, c.price, c.power, c.doors , i.url_image AS 'image', m.description AS 'model', b.description AS 'brand', s.description AS 'state', pr.description AS 'province', ty.description AS 'fuel', loc.lat, loc.lon
            FROM car c, image i, model m, brand b, state s, population p, province pr, type_motor ty, location loc
            WHERE c.chassis_number = i.chassis_number AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND c.zip_code = p.zip_code AND p.cod_province = pr.cod_province AND c.cod_typemotor = ty.cod_fuel AND s.cod_state = c.cod_state AND c.cod_location = loc.cod_location AND i.url_image  LIKE '%/prtd-%' 
            LIMIT $limit, $offset;";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function count_all_cars(){  
            // $sql = "SELECT COUNT(*) as 'cant_coches'
            // FROM car c, image i, model m, brand b, state s, population p, province pr, type_motor ty, location loc
            // WHERE c.chassis_number = i.chassis_number AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND c.zip_code = p.zip_code AND p.cod_province = pr.cod_province AND c.cod_typemotor = ty.cod_fuel AND s.cod_state = c.cod_state AND c.cod_location = loc.cod_location AND i.url_image  LIKE '%/prtd-%' ;";

            $sql = "CALL count_all_cars(@cant_coches); ";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if(mysqli_num_rows($res)>0){
                while($row = mysqli_fetch_assoc($res)){
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function select_one_car($id){  
            $sql = "SELECT c.cod_car,c.chassis_number, c.license_plate, c.km, c.price, c.price, c.enrollment_date,c.publication_date,c.doors,c.places,c.color,c.trunk_capacity,c.power, m.description AS 'model', 
            b.description AS 'brand', s.description AS 'state', sh.description AS 'shifter', p.description AS 'population', pr.description AS 'province', cyl.description AS 'cylinder_capacity', bd.description AS 'bodywork', 
            e.description AS 'environmental_label', t.description AS 'type_motor', loc.lon AS 'lon', loc.lat AS 'lat', i.url_image AS 'img'
            FROM car c, model m, brand b, state s, population p, province pr, environmental_label e, type_motor t, cylinder_capacity cyl, bodywork bd, shifter sh, location loc, image i
            WHERE m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND s.cod_state = c.cod_state AND c.zip_code = p.zip_code AND pr.cod_province = p.cod_province AND c.cod_label = e.cod_label 
            AND c.cod_typemotor = t.cod_fuel AND c.cod_cylinder AND c.cod_cylinder = cyl.cod_cylinder AND c.cod_bodywork = bd.cod_bodywork AND c.cod_shifter = sh.cod_shifter AND loc.cod_location = c.cod_location AND i.chassis_number = c.chassis_number
            AND i.url_image LIKE '%/prtd-%'
            AND c.cod_car = $id;";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $conexion = connect::con();
		    $res = mysqli_query($conexion, $sql)->fetch_object();
		    connect::close($conexion);

		    return $res;
            
        }

        function select_imgs_car($id){
            $sql = "SELECT i.*
            FROM image i
            WHERE i.url_image NOT LIKE '%/prtd-%' AND i.chassis_number = (SELECT c.chassis_number
            FROM car c
            WHERE c.cod_car = $id)";
    
            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
    
            $imgArray = array();
            if (mysqli_num_rows($res) > 0) {
                foreach ($res as $row) {
                    array_push($imgArray, $row);
                }
            }
            return $imgArray;
        }

        

    // MENU LATERAL
        function search_fuel(){  
            $sql = "SELECT t.cod_fuel, t.description AS 'type_fuel'
            FROM type_motor t";

                $conexion = connect::con();
                $res = mysqli_query($conexion, $sql);
                connect::close($conexion);

                $return = array();
                if (mysqli_num_rows($res) > 0) {
                    foreach ($res as $row) {
                        array_push($return, $row);
                    }
                }
                return $return;
            
        }

        function search_brands(){  
            $sql = "SELECT b.cod_brand, b.description AS 'brand_name'
            FROM brand b ";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $return = array();
            if (mysqli_num_rows($res) > 0) {
                foreach ($res as $row) {
                    array_push($return, $row);
                }
            }
            return $return;
            
        }

        function search_shifter(){  
            $sql = "SELECT s.cod_shifter, s.description AS 'type_shifter' 
                    FROM shifter s";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $return = array();
            if (mysqli_num_rows($res) > 0) {
                foreach ($res as $row) {
                    array_push($return, $row);
                }
            }
            return $return;
            
        }

        function search_environmental_label(){  
            $sql = "SELECT e.cod_label, e.description AS 'environmental_label'
                    FROM environmental_label e";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $return = array();
            if (mysqli_num_rows($res) > 0) {
                foreach ($res as $row) {
                    array_push($return, $row);
                }
            }
            return $return;
            
        }

        // Filter

        function filters($filter,$limit, $offset){
            $sql = "SELECT kk.*
            FROM (SELECT c.cod_car, YEAR(c.enrollment_date) AS 'year', c.km, c.publication_date, c.enrollment_date, c.color, c.price, c.power, c.doors , i.url_image AS 'image', b.cod_brand, ty.cod_fuel,
                        m.description AS 'model', b.description AS 'brand', s.description AS 'state', pr.description AS 'province', ty.description AS 'fuel', sh.description AS 'type_shifter',
                        env.description AS 'environmental_label', loc.lat, loc.lon, bw.cod_bodywork, p.description AS 'population', vis.num_visits
                        FROM car c, image i, model m, brand b, state s, population p, province pr, type_motor ty, shifter sh, environmental_label env, location loc, bodywork bw, visits vis
                        WHERE c.chassis_number = i.chassis_number AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND c.zip_code = p.zip_code AND p.cod_province = pr.cod_province 
                        AND c.cod_typemotor = ty.cod_fuel AND s.cod_state = c.cod_state AND sh.cod_shifter = c.cod_shifter AND env.cod_label = c.cod_label AND c.cod_location = loc.cod_location AND c.cod_bodywork = bw.cod_bodywork AND c.cod_car = vis.cod_car AND i.url_image LIKE '%/prtd-%') as kk";
            
            for ($i=0; $i < count($filter); $i++){
                if($filter[$i][0] === 'ORDER BY'){
                    $sql.= " ORDER BY kk.". $filter[$i][1] ;
                }else {
                    if ($i==0){
                        $sql.= " WHERE kk." . $filter[$i][0] . " LIKE '" . $filter[$i][1]. "'";
                    }else{
                        $sql.= " AND kk." . $filter[$i][0] . " LIKE '" . $filter[$i][1] . "'";
                    }
                }
            }

            $sql.=" LIMIT $limit, $offset;";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
            
        }

        function count_filters($filter){
            $sql = "SELECT COUNT(*) as 'cant_coches'
            FROM (SELECT c.cod_car, YEAR(c.enrollment_date) AS 'year', c.km, c.publication_date, c.enrollment_date, c.color, c.price, c.power, c.doors , i.url_image AS 'image', b.cod_brand, ty.cod_fuel,
                        m.description AS 'model', b.description AS 'brand', s.description AS 'state', pr.description AS 'province', ty.description AS 'fuel', sh.description AS 'type_shifter',
                        env.description AS 'environmental_label', loc.lat, loc.lon, bw.cod_bodywork, p.description AS 'population', vis.num_visits
                        FROM car c, image i, model m, brand b, state s, population p, province pr, type_motor ty, shifter sh, environmental_label env, location loc, bodywork bw, visits vis
                        WHERE c.chassis_number = i.chassis_number AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND c.zip_code = p.zip_code AND p.cod_province = pr.cod_province 
                        AND c.cod_typemotor = ty.cod_fuel AND s.cod_state = c.cod_state AND sh.cod_shifter = c.cod_shifter AND env.cod_label = c.cod_label AND c.cod_location = loc.cod_location AND c.cod_bodywork = bw.cod_bodywork AND c.cod_car = vis.cod_car AND i.url_image LIKE '%/prtd-%') as kk";
            
            for ($i=0; $i < count($filter); $i++){
                if($filter[$i][0] === 'ORDER BY'){
                    $sql.= " ORDER BY kk.". $filter[$i][1] ;
                }else {
                    if ($i==0){
                        $sql.= " WHERE kk." . $filter[$i][0] . " LIKE '" . $filter[$i][1]. "'";
                    }else{
                        $sql.= " AND kk." . $filter[$i][0] . " LIKE '" . $filter[$i][1] . "'";
                    }
                }
            }

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
            
        }

        function saveFilters($filter){
            $sql="INSERT INTO `historyfilters` (`token_guest`, `dateSearch`, `filters`) VALUES (' $filter[0] ',NOW(),'";


            for($i=0;$i<count($filter[1]);$i++){
                if($i == count($filter[1]) - 1){
                    $sql.=$filter[1][$i][0].",".$filter[1][$i][1];
                }else if($i == 0){
                    $sql.=$filter[1][$i][0].",".$filter[1][$i][1].":";
                }else{
                    $sql.=$filter[1][$i][0].",".$filter[1][$i][1].":";
                }
            }

            $sql.="' );";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);
            
        }

        function seeLastFilters($token){
            $sql="SELECT his.filters
            FROM historyfilters his
            WHERE his.token_guest LIKE '%$token%' AND his.dateSearch = DATE(NOW())";

            $conexion = connect::con();
            $res = mysqli_query($conexion, $sql);
            connect::close($conexion);

            $retrArray = array();
            if ($res -> num_rows > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $retrArray[] = $row;
                }
            }
            return $retrArray;
        }

        function checkIfExistsInVisits($cod_car){
            $sql = "CALL increment_visits(".$cod_car.");";

            $conexion1 = connect::con();
            $resInsert = mysqli_query($conexion1, $sql);
            connect::close($conexion1);
        }


// ============== SIMILAR CARS ================ //

    function similarCars($cod_car){
        $sql = "SELECT DISTINCT kk.*
        FROM (SELECT c.cod_car, YEAR(c.enrollment_date) AS 'year', c.km, c.publication_date, c.enrollment_date, c.color, c.price, c.power, c.doors , i.url_image AS 'image', b.cod_brand, ty.cod_fuel, c.cod_typemotor,
                    m.description AS 'model', b.description AS 'brand', s.description AS 'state', pr.description AS 'province', ty.description AS 'fuel', sh.description AS 'type_shifter',
                    env.description AS 'environmental_label', loc.lat, loc.lon, bw.cod_bodywork, p.description AS 'population', vis.num_visits
                    FROM car c, image i, model m, brand b, state s, population p, province pr, type_motor ty, shifter sh, environmental_label env, location loc, bodywork bw, visits vis
                    WHERE c.chassis_number = i.chassis_number AND m.cod_model = c.cod_model AND b.cod_brand = m.cod_brand AND c.zip_code = p.zip_code AND p.cod_province = pr.cod_province 
                    AND c.cod_typemotor = ty.cod_fuel AND s.cod_state = c.cod_state AND sh.cod_shifter = c.cod_shifter AND env.cod_label = c.cod_label AND c.cod_location = loc.cod_location AND c.cod_bodywork = bw.cod_bodywork AND c.cod_car = vis.cod_car AND i.url_image LIKE '%/prtd-%') as kk, car cf, model mf
                    WHERE cf.cod_car = $cod_car AND cf.cod_model = mf.cod_model AND kk.cod_brand = mf.cod_brand ";
        

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
        
    }

    // ================= LIKES ================= //
    function checkLikes($username, $cod_car){
        $sql = "CALL likeOrDislike('$username',$cod_car,@result);";
        $sql.= "SELECT @result AS 'result_operacion'";

        $conexion = connect::con();
        mysqli_multi_query($conexion, $sql);
        // Recorremos el retorno de mysql para comprobar si hay resultado hasta que lo encontramos y lo devolvemos con do-while
        $res = null;
        do {
            if ($result = mysqli_store_result($conexion)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $res = $row['result_operacion'];
                }
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conexion));
        connect::close($conexion);

        return $res;
    }

    function likesUser($username){
        $sql = "SELECT cod_car
        FROM likes
        WHERE username LIKE '$username'";
        

        $conexion = connect::con();
        $res = mysqli_query($conexion, $sql);
        connect::close($conexion);

        $retrArray = array();
        if ($res -> num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $retrArray[] = $row;
            }
        }
        return $retrArray;
        
    }

}


        

        
?>