<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $id = trim($_GET['dept_id']);

    if(empty($id)){
        $result = "Record not found.";
    }elseif(!intval($id)){
        $result = "Unable to read request.";
    }else{

        $dept = new Department();

        if($dept->select_department_by_id($id) === false){
            $result = "Error connecting to database.";
        }else{
            $result = $dept->select_department_by_id($id);
            $success = true;
        }

    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);