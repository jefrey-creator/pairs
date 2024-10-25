<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();

    $success = false;
    $result = "";
    $status = 2;
    $page = trim($_GET['page']);
    $itemPerPage = ITEM_PER_PAGE;
    $offset = ($page - 1) * $itemPerPage;

    if(!intval($page) || $page < 1){

        $result = "No data available.";

    }else{

        if($borrow->order_number($status, $offset, $itemPerPage) === false){
            $result = "No data available.";
        }else{
            $success = true;
            $result = $borrow->order_number($status, $offset, $itemPerPage);
        }
    }

    
    
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);