<?php 

    session_start();

    include_once 'private/ini.php';
    include_once 'vendor/autoload.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    try {

        $key = API_KEY;
        $decoded = JWT::decode($_SESSION['token'], new Key($key, 'HS256'));

        $login = new Login();
        $data = [
            "jwt" => "",
            "acct_id" => $decoded->data->acct_id
        ];
        $login->update_login_token($data);
        session_destroy();
        header("location: index");

    } catch (\Throwable $th) {
        error_log($th->getMessage(), 0);
        header("location: redirect/401");
    }
    