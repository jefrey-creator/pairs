<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $order_num = trim($_GET['order_num']);
    $status_req = trim($_GET['status_req']);
    
    $borrow = new Borrow();

    if(!intval($order_num) || empty($order_num)){
        $result = "No data available.";
    }else{
        if($borrow->list_borrowed_items($order_num, $status_req) === false){
            $result = "No item available.";
        }else{
            $success = true;
            $result = $borrow->list_borrowed_items($order_num, $status_req);
        }
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);