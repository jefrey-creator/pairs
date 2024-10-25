<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $logs = new Logs();

    $page = trim($_GET['page']);
    $itemPerPage = ITEM_PER_PAGE;
    $offset = ($page - 1) * $itemPerPage;

    if(!intval($page) || $page < 1 || empty($page)){

        $result = "Page number must be numeric.";

    }else{

        if($logs->list_logs($offset, $itemPerPage) === false){
            $result = "No data available.";
        }else{
            $success = true;
            $result = $logs->list_logs($offset, $itemPerPage);
        }

    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);