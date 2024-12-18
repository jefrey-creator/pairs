<?php 
    session_start();
    header("Content-Type: application/json");

    include_once '../vendor/autoload.php';
    include_once '../private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $login = new Login();
    $logs = new Logs();
    $success = false;
    $result = "";

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(isset($_POST['recaptcha']) && !empty($_POST['recaptcha'])){

        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf1e3oqAAAAAPLEe93SqI4jjRYp1dXUPc-_HMVf&response=".$_POST['g-recaptcha-response']);

        if(!$response){
            $response = "Recaptcha verification failed.";
        }elseif(empty($username)){
            $result = "Username is required.";
        }elseif(empty($password)){
            $result = "Incorrect password.";
        }elseif($login->user_login($username, $password) === false){
            $result = "Incorrect username or password.";
        }else{
    
            $data = $login->get_user_logged_in($username);
    
            if($data->acct_status == 1){
                $result = "Your account has been blocked, please contact the system administrator.";
            }else{
                $key = API_KEY;
        
                $payload = [
                    'iss' => ISS,
                    'aud' => AUD,
                    'exp' => time() + (60 * 60),
                    'data' => array(
                        'username' => $username,
                        'user_type' =>  $data->user_type,
                        'acct_status' => $data->acct_status,
                        'acct_id' => $data->acct_id,
                        "acct_uuid" => $data->acct_uuid
                    )
                ];
        
                $jwt = JWT::encode($payload, $key, 'HS256');
        
                $data_val = [
                    "jwt" => $jwt,
                    "acct_id" => $data->acct_id,
                ];
        
                if($login->update_login_token($data_val)){
                    $_SESSION['token'] = $jwt;
        
                    $success = true;
                    $result = "Successfully logged in.";
                }else{
                    $result = "Login failed. Please try again.";
                }
            }
    
        }
    }else{
        $result = "Recaptcha verification failed.";
    }

   

    $act_data = [
        "user_id" => $username, 
        "action" => "Log in", 
        "ip_address" => $_SERVER['REMOTE_ADDR'], 
        "details" => $result
    ];

    $logs->insert_log($act_data);


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);

