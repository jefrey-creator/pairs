
<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");

    $logs = new Logs();

    $success = false;
    $result = "";


    $dept_id = trim($_POST['dept_id']);
    $dept_head = trim($_POST['dept_head']);
    $dept_name = trim($_POST['dept_name']);


    if(empty($dept_name)){
        $result = "Department name is required.";
    }else{
        
        $dept = new Department();

        

        if(empty($dept_id)){

            $dept_data = [
            
                "department_head" => ucwords(strtolower($dept_head)),
                "department" => strtoupper($dept_name),
            ];

            if($dept->add_department($dept_data) === true){
                $success = true;
                $result = "Department successfully added.";
            }else{
                $result = "Error connecting to database.";
            }

        }else{

            $dept_data = [
                "department_head" => ucwords(strtolower($dept_head)),
                "department" => strtoupper($dept_name),
                "department_id" => $dept_id,
            ];

            if($dept->update_department($dept_data) === true){
                $success = true;
                $result = "Department successfully updated.";
            }else{
                $result = "Error connecting to database.";
            }
        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (empty($dept_id)) ? "Add department" : "Update department", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (empty($dept_id)) ? $result . " Head:".$dept_head. " Dept:".$dept_name : $result . " Head:".$dept_head. " Dept:".$dept_name . " ID: ".$dept_id
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);