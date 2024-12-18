<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $logs = new Logs();
    
    $acct_id = trim($_POST['acct_id']);
    $acct_status = trim($_POST['acct_status']);

    if(empty($acct_id)){
        $result = "Account does not exist.";
    }elseif(!intval($acct_id)){
        $result = "Account does not exist.";
    }elseif($acct_status > 2 && $acct_status < 1){
        $result = "Unknown account status.";
    }elseif ($acct_status == "") {
        $result = "Account does not exist.";
    }else{

        $account = new Account();

        $data = [
            "acct_id" => $acct_id,
            "acct_status" => ($acct_status == 1) ? 0 : 1,
        ];
        $msg = "";
        
        if($acct_status == 1){
            //unblock
            $msg = "Account successfully unblock.";
        }else{
            //block
            $msg = "Account has been blocked.";
        }
        if($account->block_user($data) === true){
            $result = $msg;
            $success = true;
        }else{
            $result = "Error connecting to database.";
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => ($acct_status == 1) ? "User account unblocked" : "User account blocked", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[ID: ".$acct_id."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);