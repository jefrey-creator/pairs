<?php 

    include_once 'auth.php';

    $logs = new Logs();
    $item = new Item();

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $i_desc = trim($_POST['i_desc']);
    $i_qty = trim($_POST['i_qty']);
    $i_category = trim($_POST['i_category']);
    $i_assign_room = trim($_POST['i_assign_room']);
    $i_date_acquired = trim($_POST['i_date_acquired']);
    $i_status = trim($_POST['i_status']);
    $i_handler = trim($_POST['i_handler']);
    $i_price = trim($_POST['i_price']);
    $i_model = trim($_POST['i_model']);
    $i_brand = trim($_POST['i_brand']);
    $i_name = trim($_POST['i_name']);
    $i_type = trim($_POST['i_type']);
    $item_id = trim($_POST['item_id']);
    $item_uuid = (isset($_POST['item_uuid'])) ? trim($_POST['item_uuid']) : base64_encode(uniqid().time());
    
    $old_item = $item->get_item_old_data($item_uuid);
    $old_item_name = $old_item->item_name;

    if($i_qty == ""){
        $result = "Quantity must be at least 1.";
    }elseif(!intval($i_qty) || $i_qty <= 0){
        $result = "Quantity must be a number and not less than zero.";
    }elseif (empty($i_category)) {
        $result = "Please select a category.";
    }elseif (empty($i_assign_room)) {
        $result = "Please select a room to store this item.";
    }elseif (empty($i_date_acquired)) {
        $result = "Date acquired must not be empty.";
    }elseif (empty($i_status)) {
        $result = "Please select a status of this item.";
    }elseif(empty($i_handler)){
        $result = "Please select the handler of this item.";
    }elseif (empty($i_price)) {
        $result = "Item price is required.";
    }elseif (empty($i_model)) {
        $result = "Item model is required.";
    }elseif(empty($i_brand)){
        $result = "Item brand is required.";
    }elseif(empty($i_name)){
        $result = "Item name is required.";
    }elseif(empty($i_type)){
        $result = "Please select an item type.";
    }else{

        $storage = new Storage();

        $item_data = [
            "item_name" => $i_name, 
            "item_desc" => $i_desc, 
            "item_brand" => $i_brand, 
            "item_model" => $i_model, 
            "item_price" => $i_price, 
            "item_category" => $i_category, 
            "condition_id" => $i_status, 
            "acquired_by" => $i_handler, 
            "date_acquired" => $i_date_acquired, 
            "item_uuid" => $item_uuid,
            "item_type" => $i_type
        ];

        $storage_data = [
            "room_id" => $i_assign_room, 
            "item_uuid" => $item_uuid, 
            "item_qty" => $i_qty
        ];

        if(isset($_POST['item_uuid'])){

           
            // update
            if($item->update_item($item_data) === true){
                if($storage->update_stored_item($storage_data) === true){
                    $success = true;
                    $result = "Item successfully updated.";
                }else{
                    $result = "Item can't be update to the selected room.";
                }
            }else{
                $result = "Item not save.";
            }
        }else{
            //insert
           
            if($item->add_item($item_data) === true){
                if($storage->store_item($storage_data) === true){
                    $success = true;
                    $result = "Item successfully added.";
                }else{
                    $result = "Item can't be added to room selected.";
                }
            }else{
                $result = "Item not save.";
            }

        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (isset($_POST['item_uuid'])) ? "Update Item" : "Add Item", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (isset($_POST['item_uuid'])) ? $result . "[ID: ".$item_uuid."] [Old: " .$old_item_name. "][New: " .$i_name. "][Success:"  . $success. "]"  : $result . "[Item: " .$i_name. "][Success:"  . $success. "]"
    ];

    $logs->insert_log($act_data);


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);