<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $room = new Room();
    $logs = new Logs();

    $room_num = trim($_POST['room_num']);
    $room_name = trim($_POST['room_name']);
    $room_id = isset($_POST['room_id']) ? trim($_POST['room_id']) : "";

    $old_room = "";
    $old_room_name = "";
    if(isset($_POST['room_id']) && $room_id != ""){
        $old_room = $room->select_room($room_id);
        $old_room_name = $old_room->room_name;
    }

    if(empty($room_num)){
        $result = "Please enter a room number.";
    }elseif(empty($room_name)){
        $result = "Please enter a room name.";
    }else{
        
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
    
    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (!empty($room_id)) ? "Update storage room" : "Add storage room", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (!empty($room_id)) ? $result . "[ID: ".$room_id."][Old: ".$old_room_name."][New: ".$room_name."][Success: ".$success."]" : $result . "[Data: ". $room_name ."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);
    
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);