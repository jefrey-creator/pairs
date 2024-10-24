<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();

    $success = false;
    $result = "";


    $order_num = trim($_GET['order_num']);
    $status = 3;

    if(empty($order_num)){
        $result = "No data available.";
    }else{

        if($borrow->view_borrowed_item($order_num, $status) === false){
            $result = "No data available.";
        }else{
            $result = $borrow->view_borrowed_item($order_num, $status);
            $success = true;
        }

    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);