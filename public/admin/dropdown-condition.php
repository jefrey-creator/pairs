<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $item = new Item();

    if($item->dropdown_condition() === false){
        $result = "No data available.";
    }else{
        $success = true;
        $result = $item->dropdown_condition();
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);