<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $cat_id = trim($_POST['cat_id']);

    if(empty($cat_id) || !intval($cat_id)){
        $result = "Category does not exist.";
    }else{
        
        $category = new Category();

        if($category->delete_category($cat_id) === true){
            $result = "Category deleted successfully.";
            $success = true;
        }else{
            $result = "Error connecting to database.";
        }

    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);
    