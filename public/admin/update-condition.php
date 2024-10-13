<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $item = new Item();
    $success = false;
    $result = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $id = trim($_POST['condition_id']);
        $condition = trim($_POST['condition']);

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


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);