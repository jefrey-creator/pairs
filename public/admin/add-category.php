<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $cat_name = trim($_POST['cat_name']);
    $cat_id = trim($_POST['cat_id']);
    


    if(empty($cat_name)){

        $result = "Category is required.";

    }elseif(strlen($cat_name) <= 3){

        $result = "Category must be at least 3 characters long.";

    }else{

        $category = new Category();

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



    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);