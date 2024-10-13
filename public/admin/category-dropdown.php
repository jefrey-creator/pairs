<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $category = new Category();


    if($category->category_dropdown() === false){
        $result = "No data available.";
    }else{
        $success = true;
        $result = $category->category_dropdown();
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);