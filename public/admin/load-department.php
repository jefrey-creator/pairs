<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $department = new Department();

    echo json_encode($department->view_department());