<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";
    
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
        $account = new Account();

        if($account->reset_password($data) === true){
            $success = true;
            $result = "Account password successfully reset.";
        }
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);