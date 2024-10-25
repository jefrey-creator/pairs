<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();
    $storage = new Storage();
    $config = new Config();
    $account = new Account();
    $mailer = new Mailer();
    $logs = new Logs();

    $success = false;
    $result = "";

    $selectedItem = $_POST['selectedItem'];
    $selectedQty = $_POST['selectedQty'];
    $selectedRemarks = $_POST['selectedRemarks'];
    $order_number = trim($_POST['order_num']);
    $borrower_id = trim($_POST['borrower_id']);
    $qty = [];

    $email_conf = $config->set_config("item_returned");

    $req_status = [];
    

    if(!isset($_POST['selectedItem'])){

        $result = "Select an item first.";

    }else{

        $approved_item = [];
        $remaining_item_to_be_returned = 0;

        for($i = 0; $i < count($selectedItem); $i++){

            $available_qty = $storage->check_item_availability($selectedItem[$i]);
            $remaining_item_to_be_returned = $available_qty->approved_qty - $available_qty->returned_qty;

            if($selectedQty[$i] > $remaining_item_to_be_returned){

                $result = "Returning item should not be greater than the borrowed item.";
                $success = false;
                break;

            }elseif ($selectedQty[$i] <= 0 ) {

                $result = "Minimum quantity is 1.";
                $success = false;
                break;

            }elseif(!intval($selectedQty[$i])){

                $result = "Quantity must be numeric.";
                $success = false;
                break;

            }elseif (strlen($selectedRemarks[$i]) < 5) {
                $result = "Enter at least 5 character remarks for returned item.";
                $success = false;
                break;
            }
            else{

                $result = "Selected item was successfully returned.";
                $success = true;
                
            }
        }
    }

    if($success === true){

        $approved_item = [];
        
        for($i = 0; $i < count($selectedItem); $i++){

            $available_qty = $storage->check_item_availability($selectedItem[$i]);
            $total_qty_stored[] =  $selectedQty[$i] + $available_qty->max_qty;
            $returned_qty[] = $selectedQty[$i] + $available_qty->returned_qty;

            $req_status[] = ($returned_qty[$i] == $available_qty->approved_qty) ? 4 : 3;
           
            $borrow_data = [
                [
                    "status" => $req_status[$i],
                    "borrow_id" => $selectedItem[$i],
                    "returned_qty" => $returned_qty[$i],
                    "actual_date_returned" => date('Y-m-d'),
                    "remarks" => $selectedRemarks[$i],
                ],
            ];

            $storage_data = [
                [
                    "item_qty" => $total_qty_stored[$i],
                    "item_uuid" => $available_qty->item_uuid,
                ],
            ];

            $borrow->returned_item($borrow_data);
            $storage->update_qty($storage_data);

            $get_borrowed_item = $storage->get_approved_item_requested($selectedItem[$i]);

            foreach($get_borrowed_item as $item_key => $item_val){
                $approved_item[] = '<tr><td style="border: 1px solid black;">'.$item_val->item_name.'</td>
                <td style="border: 1px solid black;">'.$item_val->approved_qty.'</td>
                <td style="border: 1px solid black;">'.$selectedQty[$i].'</td>
                <td style="border: 1px solid black;">'.$item_val->date_returned.'</td>
                <td style="border: 1px solid black;">'.date('Y-m-d').'</td>
                <td style="border: 1px solid black;">'.$selectedRemarks[$i].'</td></tr>';
            }
        }

        $borrower_details = $account->get_borrower_details($borrower_id);
        
        $mail_subject = $email_conf->subject;

        $body = str_replace("[name]", ucwords(strtolower($borrower_details->borrower_name)), $email_conf->message);
        $body2 = str_replace("[order_num]", $order_number, $body);
        $str_table_data = implode(", ", $approved_item);
        $clean_row = str_replace(", ", " ", $str_table_data);
        $body3 = str_replace("<tr></tr>", $clean_row, $body2);
        
        $mailer->send_mail($borrower_details->email_address, ucwords(strtolower($borrower_details->borrower_name)), $mail_subject, $body3);

        echo json_encode([
            "success" => $success,
            "result" => $result
        ]);

    }else{

        echo json_encode([
            "success" => $success,
            "result" => $result
        ]);

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Item returned.", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[Reference Number:" .$order_number. "][Success:"  . $success. "]"
    ];

    $logs->insert_log($act_data);