<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $order_num = trim($_GET['order_num']);

    $borrow = new Borrow();

    if(!intval($order_num) || empty($order_num)){
        $result = "No data available.";
    }else{
        if($borrow->list_borrowed_items($order_num ) === false){
            $result = "No item available.";
        }else{
            $success = true;
            $result = $borrow->list_borrowed_items($order_num );
        }
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);