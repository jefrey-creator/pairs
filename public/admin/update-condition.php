<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $item = new Item();
    $logs = new Logs();
    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $id = trim($_POST['condition_id']);
        $condition = trim($_POST['condition']);

        $get_item = $item->get_item_condition_by_id($id);
        $old_item_name = $get_item->condition;

        $data = [
            "id" => intval($id),
            "condition" => strtoupper($condition),
        ];
    
        if(!intval($id)){
            $result = "Record not found.";
        }elseif(empty($id)){
            $result = "Record not found.";
        }elseif(empty($condition)){
            $result = "Condition is required.";
        }
        else{
            if($item->update_condition($data) === true){
                $success = true;
                $result = "Condiition successfully updated.";
            }else{
                $result = "Error updating condition.";
            }
        }
    }else{
        $result = "Unauthorized request.";
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Update Item Condition", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[new data:" . $condition . " id:" . $id."][old data: ". $old_item_name ."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);