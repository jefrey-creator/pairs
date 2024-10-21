<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");


    $status_req = trim($_GET['status_req']);
    $borrower_id = $decoded->data->acct_id;
    $result = "";
    $success = false;


    if(empty($status_req) OR !intval($status_req)){
        $result = "No item available.";
    }else{

        $borrow = new Borrow();
        
        if($borrow->borrowed_item_by_order_num($borrower_id, $status_req) === false){
            $result = "No item available";
        }else{
            $result = $borrow->borrowed_item_by_order_num($borrower_id, $status_req);
            $success = true;
        }
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);
