<?php 

    session_start();

    include_once './vendor/autoload.php';
    include_once './private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    try {

        $key = API_KEY;
        $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));

        if($decoded->data->user_type == 2){
            header("location: ./public/admin/");
        }elseif($decoded->data->user_type == 1){
            header("location: ./public/staff/");
        }else{
            header("location: logout");
        }

    } catch (\Throwable $th) {
        error_log($th->getMessage(), 0);
        header("location: ./redirect/401");
    }
