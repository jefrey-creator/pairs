<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $logs = new Logs();
    $category = new Category();

    $cat_name = trim($_POST['cat_name']);
    $cat_id = trim($_POST['cat_id']);
    
    $old_category = (!empty($cat_id)) ? $category->select_category($cat_id) : "";
    $old_cat = $old_category->cat_name;

    if(empty($cat_name)){

        $result = "Category is required.";

    }elseif(strlen($cat_name) <= 3){

        $result = "Category must be at least 3 characters long.";

    }else{

        

        if(!empty($cat_id) && intval($cat_id)){

            $data = [
                "cat_name" => strtoupper($cat_name),
                "cat_id" => $cat_id
            ];

            if($category->update_category($data) === true){

                $success = true;
                $result = "Category updated successfully.";
    
            }else{
    
                $result = "Error connecting to database.";
    
            }
        }else{

            if($category->add_category(strtoupper($cat_name)) === true){

                $success = true;
                $result = "Category added successfully.";
    
            }else{
    
                $result = "Error connecting to database.";
    
            }
        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (!empty($cat_id)) ? "Update category" : "Add category", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (!empty($cat_id)) ? $result . "[ID: ".$cat_id."][Old: ".$old_cat."][New: ".$cat_name."][Success: ".$success."]" : $result . "[Data: ". $cat_name ."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);