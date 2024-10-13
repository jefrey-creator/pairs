<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $room_id = trim($_POST['room_id']);

    if(!intval($room_id)){
        $result = "Room not found.";
    }elseif(empty($room_id)){
        $result = "Room not found.";
    }else{

        $room = new Room();

        if($room->delete_room($room_id) === true){
            $success = true;
            $result = "Room successfully deleted.";
        }else{
            $result = "Error connecting to database.";
        }
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);