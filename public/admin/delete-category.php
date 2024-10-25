<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";
    $category = new Category();
    $logs = new Logs();


    $cat_id = trim($_POST['cat_id']);
    $old_category = (!empty($cat_id)) ? $category->select_category($cat_id) : "";
    $old_cat = $old_category->cat_name;

    if(empty($cat_id) || !intval($cat_id)){
        $result = "Category does not exist.";
    }else{
        
        
        if($category->delete_category($cat_id) === true){
            $result = "Category deleted successfully.";
            $success = true;
        }else{
            $result = "Error connecting to database.";
        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Delete category", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[ID: ".$cat_id."] [Data: ".$old_cat."] [Success: ".$success."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);
    