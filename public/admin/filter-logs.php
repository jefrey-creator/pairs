<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $logs = new Logs();

    $filterInput = trim($_GET['filterInput']);

    $data = [
        "date" => $filterInput."%"
    ];

    if(empty($filterInput)){

        $result = "No data available.";

    }else{

        if($logs->filter_logs($data) === false){
            $result = "No data available.";
        }else{
            $success = true;
            $result = $logs->filter_logs($data);
        }

    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);