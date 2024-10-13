<?php 

    include_once 'auth.php';
    $item = new Item();

    header("Content-Type: application/json");

    $success = false;
    $result = "";
    $page = trim($_GET['page']);
    $item_per_page = ITEM_PER_PAGE;
    $offset = ($page-1) * $item_per_page;

    if($item->get_item_condition($offset, $item_per_page) === false){
        $result = "No result present.";
    }else{
        $success = true;
        $result = $item->get_item_condition($offset, $item_per_page);
    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);