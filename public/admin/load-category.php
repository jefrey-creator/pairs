<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $page = $_GET['page'];
    $itemPerPage = ITEM_PER_PAGE;
    $offset = ($page-1) * $itemPerPage;

    if(!intval($page)){
        $result = "Page number error.";
    }elseif($page < 1){
        $result = "Page must start at 1.";
    }else{

        $category = new Category();

        if($category->load_category($offset, $itemPerPage) === false){
            $result = "No data available.";
        }else{
            $result = $category->load_category($offset, $itemPerPage);
            $success = true;
        }
    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);