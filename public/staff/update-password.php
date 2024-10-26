<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $account = new Account();
    $logs = new Logs();

    $id = $user_details->acct_uuid;

    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $password_confirmation = trim($_POST['password_confirmation']);
    $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';
    $hash_password = password_hash($new_password, PASSWORD_BCRYPT);

    if(empty($id)){
        $result = "Account does not exist.";
    }elseif(empty($current_password)){
        $result = "Current password is incorrect.";
    }elseif ($new_password != $password_confirmation) {
        $result = "New password must be the same as the confirmation password.";
    }elseif (strlen($new_password) < 8) {
        $result = "New password must be at least 8 characters long.";
    }elseif(!preg_match($pattern, $new_password)){
        $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
    }elseif(!$login->user_login($decoded->data->username, $current_password)){
        $result = "Current password is incorrect.";
    }else{
        if($account->change_password($id, $hash_password) === true){
            $success = true;
            $result = "Password successfully updated.";
        }else{
            $result = "Error updating password. Make sure that this is your account.";
        }
    }
    
    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Change Password", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" =>  $result . "[ID: ".$id."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);