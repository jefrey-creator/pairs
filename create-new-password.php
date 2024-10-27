<?php 
    
    header("Content-Type: application/json");
    include_once 'vendor/autoload.php';
    include_once 'private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $account = new Account();
    $logs = new Logs();

    $result = "";
    $success = false;

    $new_password = trim($_POST['new_password']);
    $confirm_new_password = trim($_POST['confirm_new_password']);
    $key = API_KEY;
    $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';
    
    $token = trim($_POST['token']);
    try {

        $decoded = JWT::decode($token, new Key($key, 'HS256'));
       
        if(!$account->find_user($decoded->data->username)){

            $result = "Link expired.";
            $success = false;
    
        }elseif(!preg_match($pattern, $new_password) || empty($new_password)){
                
            $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
            $success = false;
    
        }elseif ($new_password != $confirm_new_password) {
    
            $result = "New password must be the same as the confirmation password.";
            $success = false;
    
        }elseif (strlen($new_password) < 8) {
    
            $result = "New password must be at least 8 characters long.";
            $success = false;
    
        }else{
    
            $hash_password = password_hash($new_password, PASSWORD_BCRYPT);
            $acct_uuid = $decoded->data->acct_uuid;
    
            $token_data = [
                "reset_token" => NULL,
                "acct_uuid" => $acct_uuid
            ];
    
            if($account->change_password($acct_uuid, $hash_password) === true){
                if($account->update_reset_token($token_data) === true){
                    $result = "Password successfully changed.";
                    $success = true;
                }else{
                    $result = "Invalid token.";
                    $success = false;
                }
            }else{
                $result = "Invalid token.";
                $success = false;
            }
        }


    } catch (\Throwable $th) {

        // $success = false;
        $result = "Link expired.";
        // header("location: redirect/401");

        error_log($th->getMessage(), 0);
    }

    


    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Reset Password",
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" =>  $result . "[ID: ".$decoded->data->acct_uuid."]"
    ];

    $logs->insert_log($act_data);
    
    
    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);
    