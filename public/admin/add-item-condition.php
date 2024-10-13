<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $item = new Item();
    $success = false;
    $result = "";

    $item_condition = trim(strtoupper($_POST['item_condition']));

    if(empty($item_condition)){
        $result = "Condition is required.";
    }else{
        
        if($item->add_item_condition($item_condition)=== true){
            
            $success = true;
            $result = "Condition successfully saved.";
        }else{
            $result = "Error saving data.";
        }
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);