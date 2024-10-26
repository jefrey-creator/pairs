<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $id = $user_details->acct_uuid;

    if(empty($id)){
        $result = "No data selected.";
    }else{

        $acct = new Account();

        if($acct->select_user_by_id($id) === false){
            $result = "Record does not exist.";
        }else{
            $success = true;
            $result = $acct->select_user_by_id($id);
        }
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);