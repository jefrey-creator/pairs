<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $page = trim($_GET['page']);
    $itemPerPage = ITEM_PER_PAGE;
    $offset = ($page-1) * $itemPerPage;

    if(empty($page)){
        $result = "Page not found.";
    }elseif(!intval($page)){
        $result = "Page must be a number";
    }else{

        $handler = new Handler();

        if($handler->view_handler($offset, $itemPerPage) === false){
            $result = "No data available.";
        }else{
            $success = true;
            $result = $handler->view_handler($offset, $itemPerPage);
        }
    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);