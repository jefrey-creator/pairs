<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $result = "";
    $success = false;

    $id = trim($_POST['dept_id']);

    if(empty($id)){
        $result = "Data does not exist.";
    }elseif(!intval($id)){
        $result = "Data not deleted.";
    }else{

        $department = new Department();

        if($department->delete_department($id) === true){
            $success = true;
            $result = "Department has been deleted.";
        }else{
            $result = "Error connecting to database.";
        }
    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);