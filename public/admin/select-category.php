<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $cat_id = trim($_GET['cat_id']);
    


    if(empty($cat_id)){
        $result = "Category does not exist.";
    }elseif(!intval($cat_id)){
        $result = "Category not found.";
    }else{

        $category = new Category();

        if($category->select_category($cat_id) === false){

            
            $result = "Error connecting to database.";

        }else{
            $success = true;
            $result = $category->select_category($cat_id);
            
        }

    }



    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);