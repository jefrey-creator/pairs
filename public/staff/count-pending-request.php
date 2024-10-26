<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();

    $result = "";

    $status = 1;
    $user_id = $user_details->acct_id;

    $result = $borrow->count_approved_item($status, $user_id);

    echo json_encode([
        "result" => $result,
    ]);