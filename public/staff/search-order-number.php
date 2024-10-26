
<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";

    $borrow = new Borrow();

    $success = false;
    $result = "";
    $status = trim($_GET['status']);
    $borrower_id = $user_details->acct_id;
    
    $reference_number = trim($_GET['reference_number']);

    if(!intval($reference_number) || !intval($status) || $status < 1){
        $result = "No results found.";
    }else{
        if($borrow->search_my_order_number($status, $reference_number, $borrower_id) === false){
            $result = "No data available.";
        }else{
            $success = true;
            $result = $borrow->search_my_order_number($status, $reference_number, $borrower_id);
        }
    }
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);