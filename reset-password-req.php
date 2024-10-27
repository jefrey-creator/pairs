<?php 

    header("Content-Type: application/json");

    include_once 'vendor/autoload.php';
    include_once 'private/ini.php';

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

    $result = "";
    $success = false;

    $username = trim($_POST['username']);

    $account = new Account();
    $mailer = new Mailer();
    $logs = new Logs();
    $config = new Config();

    $data = [
        "username" => $username,
        "email_address" => $username
    ];

    $user_account = $account->find_user($data);

    $mail_config = $config->set_config("forgot_password");
   

    if(empty($username)){
        $result = "Enter your email or username to proceed.";
    }else{
        if($user_account){

            $key = API_KEY;
        
            $payload = [
                'iss' => ISS,
                'aud' => AUD,
                'exp' => time() + (60 * 60),
                'data' => array(
                    'username' => $username,
                    "acct_uuid" => $user_account->acct_uuid
                )
            ];
        
            $jwt = JWT::encode($payload, $key, 'HS256');
    
            $token_data = [
                "acct_uuid" => $user_account->acct_uuid,
                "reset_token" => $jwt
            ];

            $subject = $mail_config->subject;
            $recipient_email = $user_account->email_address;
            $body = str_replace("[username]", ucwords(strtolower($user_account->full_name)), $mail_config->message);
            $body2 = str_replace("[token]", $jwt, $body);
            $full_name = ucwords(strtolower($user_account->full_name));
    
            if($account->update_reset_token($token_data) === true){
                if($mailer->public_mail($recipient_email, $full_name, $subject, $body2) === true){
                    $result = "If the provided email or username matches our records, we will send you instructions to reset your password. Please check your inbox";
                    $success = true;
                }else{
                    $result = "Sorry! This account has an invald email address.";
                }
            }else{
                $result = "Sorry! We cannot reset your password, please make sure that this account belongs to you.";
            }
            
        }else{
    
            $result = "If the provided email or username matches our records, we will send you instructions to reset your password. Please check your inbox";
            $success = true;
    
        }
    }

    $act_data = [
        "user_id" => $username, 
        "action" => "Password Reset Request", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => " [Data: [Username: ". $username ."]] [Success: ".$success."]"
    ];

    $logs->insert_log($act_data);
    

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);

    