<?php
    include('C:\xampp\htdocs\coches_net\model\JWT.php');

    function decode_token($token){
        $jwt = parse_ini_file('C:\xampp\htdocs\coches_net\model\jwt.ini');
        $secret = $jwt['secret'];
    
        $JWT = new JWT;
        $token_dec = $JWT->decode($token, $secret);
        $rt_token = json_decode($token_dec, TRUE);
        return $rt_token;
    }
    
    function create_token($username){
        $jwt = parse_ini_file('C:\xampp\htdocs\coches_net\model\jwt.ini');
        $header = $jwt['header'];
        $secret = $jwt['secret'];
        $payload = '{"iat":"' . time() . '","exp":"' . time() + (14000) . '","username":"' . $username . '"}';
    
        $JWT = new JWT;
        $token = $JWT->encode($header, $payload, $secret);
        return $token;
    }

    function create_token_refresh($username){
        $jwt = parse_ini_file('C:\xampp\htdocs\coches_net\model\jwt.ini');
        $header = $jwt['header'];
        $secret = $jwt['secret'];
        $payload = '{"iat":"' . time() . '","exp":"' . time() + (600) . '","username":"' . $username . '"}';
    
        $JWT = new JWT;
        $token = $JWT->encode($header, $payload, $secret);
        return $token;
    }
?>