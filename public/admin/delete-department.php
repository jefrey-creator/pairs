<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $logs = new Logs();
    $department = new Department();

    $result = "";
    $success = false;

    $id = trim($_POST['dept_id']);

    $get_dept = $department->select_department_by_id($id);
    $dept_name = $get_dept->department;
    $dept_head = $get_dept->department_head;

    if(empty($id)){
        $result = "Data does not exist.";
    }elseif(!intval($id)){
        $result = "Data not deleted.";
    }else{

        if($department->delete_department($id) === true){
            $success = true;
            $result = "Department has been deleted.";
        }else{
            $result = "Error connecting to database.";
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Delete department", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => "Data: [ID: ".$id ." Dept: ".$dept_name . " Head:" . $dept_head ."]",
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);