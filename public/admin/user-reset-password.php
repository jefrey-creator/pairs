<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $logs = new Logs();
    $account = new Account();
    
    $acct_id = trim($_POST['acct_id']);
    $password = trim($_POST['password']);
    $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';

    if(empty($acct_id)){
        $result = "Account does not exist.";
    }elseif(!intval($acct_id)){
        $result = "Account data does not match.";
    }elseif(strlen($password) <= 8){
        $result = "Password must be at least 8 characters long.";
    }elseif(!preg_match($pattern, $password)){
        $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
    }elseif(empty($password)){
        $result = "Password cannot be empty.";
    }
    else{
        $data = [
            "acct_id" => $acct_id,
            "password" => password_hash($password, PASSWORD_DEFAULT),
        ];        
        
        if($account->reset_password($data) === true){
            $success = true;
            $result = "Account password successfully reset.";
        }
    }


    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Password Reset", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[ID: ".$acct_id."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);