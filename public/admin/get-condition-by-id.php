<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $item = new Item();
    $success = false;
    $result = "";

    $id = trim($_GET['id']);

    if(!intval($id)){
        $result = "Record not found.";
    }elseif(empty($id)){
        $result = "Record not found.";
    }else{
        $result = $item->get_item_condition_by_id($id);
        $success = true;
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);