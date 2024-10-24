<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();

    $result = "";

    $status = 1;

    $result = $borrow->count_borrowed_item($status);

    echo json_encode([
        "result" => $result,
    ]);