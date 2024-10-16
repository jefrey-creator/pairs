<?php 

    session_start();

    include_once '../../vendor/autoload.php';
    include_once '../../private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    if(!isset($_SESSION['token'])){

        header("location: ../../redirect/401");
        // echo "Session not set";
    }else{

        try {

            $key = API_KEY;
            $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));
    
            if($decoded->data->user_type != 2){
                header("location: ../../redirect/401");
            }

            // if($decoded->data->login_token == ""){
            //     header("location: ../../redirect/401");
            // }

            // print_r($decoded);

        } catch (\Throwable $th) {
            error_log($th->getMessage(), 0);
            header("location: ../../redirect/401");
        }

    }

   