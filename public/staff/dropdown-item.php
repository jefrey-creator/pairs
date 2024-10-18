<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $borrow = new Borrow();

    if($borrow->dropdown_item() === false){
        $result = "No item available.";
    }else{
        $success = true;
        $result = $borrow->dropdown_item();
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);