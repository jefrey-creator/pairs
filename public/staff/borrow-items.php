<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $borrow = new Borrow();
    $mailer = new Mailer();
    $config = new Config();
    $email_conf = $config->set_config("borrow_item");

    $result = "";
    $success = false;

    $borrower_id = $decoded->data->acct_id;
    $arr_item_uuid = $_POST['arr_item_uuid'];
    $arr_item_qty = $_POST['arr_item_qty'];
    $arr_item_return_date = $_POST['arr_item_return_date'];
    $arr_purpose = $_POST['arr_purpose'];
    $date_borrowed = $borrow->get_server_time();

    if(!intval($borrower_id) && empty($borrower_id)){

        $result = "You must login first, before borrowing any item/equipment.";

    }else{

        for ($i = 0; $i < sizeof($arr_item_uuid); $i++) {
            
            if (empty($arr_item_uuid[$i])) {
    
                $result = "Please select an item first.";
                
            } elseif (empty($arr_item_qty[$i]) || !intval($arr_item_qty[$i]) || intval($arr_item_qty[$i]) < 1) {
    
                $result = "Quantity must be at least 1.";
                
            } elseif (empty($arr_item_return_date[$i])) {
    
                $result = "Expected date of return is required.";
                
            } elseif (empty($arr_purpose[$i])) {
    
                $result = "You must provide a purpose for each requesting item.";
    
            } else {
                
                $borrow_data = [
                    [
                        "borrower_id" => $borrower_id, 
                        "date_borrowed" => $date_borrowed->server_time,
                        "date_returned" => $arr_item_return_date[$i], 
                        "item_id" => $arr_item_uuid[$i], 
                        "borrowed_qty" => $arr_item_qty[$i], 
                        "purpose" => $arr_purpose[$i],
                    ],
                ];
                
                $subject = $email_conf->subject;
                // $body = str_replace("[item]", $arr_item_uuid[$i],  $email_conf->message);


                if($borrow->add_borrowing($borrow_data) === true){
                    $result = "Your item(s) have been successfully requested. Please hold on while the custodian processes your request. You will receive an email notification once it is approved.";
                    $success = true;
                }else{
                    $result = "Error connecting database.";
                }
            }
        }
    }

    // Return a JSON response
    echo json_encode([
        "success" => $success,
        "result" => $body
    ]);