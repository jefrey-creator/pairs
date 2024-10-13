<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $room = new Room();

    if($room->dropdown_room() === false){
        $result = "No data available.";
    }else{
        $success = true;
        $result = $room->dropdown_room();
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);