<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $room_num = trim($_POST['room_num']);
    $room_name = trim($_POST['room_name']);
    $room_id = trim($_POST['room_id']);


    if(empty($room_num)){
        $result = "Please enter a room number.";
    }elseif(empty($room_name)){
        $result = "Please enter a room name.";
    }else{
        $room = new Room();
        if(!empty($room_id) && intval($room_id)){
            $data = [
                "room_name" => strtoupper($room_name),
                "room_num" => $room_num,
                "room_id" => $room_id
            ];

            if($room->update_room($data) === true){
                $result = "Room updated successfully.";
                $success = true;
            }else{
                $result = "Error connecting to database.";
            }

        }else{
            
            $data = [
                "room_name" => strtoupper($room_name),
                "room_num" => $room_num
            ];
            if($room->add_room($data) === true){
                $result = "Room added successfully.";
                $success = true;
            }else{
                $result = "Error connecting to database.";
            }
        }

        
       
    }
    
    
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);