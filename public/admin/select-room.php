<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $room_id = trim($_GET['room_id']);

    if(!intval($room_id)){
        $result = "Room not found.";
    }elseif(empty($room_id)){
        $result = "Room not found.";
    }else{

        $room = new Room();

        if($room->select_room($room_id) === false){
            $result = "Error connecting to database.";
            
        }else{
            $success = true;
            $result = $room->select_room($room_id);
        }
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);