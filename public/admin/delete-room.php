<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";
    $room = new Room();
    $logs = new Logs();

    $room_id = trim($_POST['room_id']);
    $old_room = $room->select_room($room_id);
    $old_room_name = $old_room->room_name;

    if(!intval($room_id)){
        $result = "Room not found.";
    }elseif(empty($room_id)){
        $result = "Room not found.";
    }else{

       

        if($room->delete_room($room_id) === true){
            $success = true;
            $result = "Room successfully deleted.";
        }else{
            $result = "Error connecting to database.";
        }
    }
     
    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Delete storage room", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[ID:" . $room_id ."][Data: ".$old_room_name."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);