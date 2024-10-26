<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $borrow = new Borrow();

    $page = trim($_GET['page']);
    $itemPerPage = ITEM_PER_PAGE;
    $offset = ($page -1) * $itemPerPage;
    $borrower_id = $user_details->acct_id;
    $status = 2;

    $success = false;
    $result = "";

    if(!intval($page) || $page < 1 || empty($page)){
        $result = "Page number must be numeric.";
    }else{
        if($borrow->my_order_number($status, $borrower_id, $offset, $itemPerPage) === false){
            $success = false;
            $result = "No data available.";
        }else{
            $success = true;
            $result = $borrow->my_order_number($status, $borrower_id, $offset, $itemPerPage);
        }
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);