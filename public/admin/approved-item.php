<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();
    $storage = new Storage();
    $config = new Config();
    $account = new Account();
    $mailer = new Mailer();

    $success = false;
    $result = "";

    $selectedItem = $_POST['selectedItem'];
    $selectedQty = $_POST['selectedQty'];
    $oder_number = trim($_POST['order_num']);
    $borrower_id = trim($_POST['borrower_id']);


    $email_conf = $config->set_config("req_approved");
    

    if(!isset($_POST['selectedItem'])){

        $result = "Select an item first.";

    }else{

        $order_tbl = [];

        for($i = 0; $i < count($selectedItem); $i++){

            $available_qty = $storage->check_item_availability($selectedItem[$i]);

            if($selectedQty[$i] > $available_qty->max_qty){

                $result = "Maximum quantity entered has exceeded for an item.";
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

            }else{

                $result = "Selected item was approved successfully.";
                $success = true;
                
            }
        }
    }

    if($success === true){

        $approved_item = [];

        for($i = 0; $i < count($selectedItem); $i++){

            $available_qty = $storage->check_item_availability($selectedItem[$i]);

            $total_qty[] = $available_qty->max_qty - $selectedQty[$i];
            $borrow_data = [
                [
                    "status" => 2,
                    "borrow_id" => $selectedItem[$i],
                    "approved_qty" => $selectedQty[$i]
                ],
            ];

            $storage_data = [
                [
                    "item_qty" => $total_qty[$i],
                    "item_uuid" => $available_qty->item_uuid
                ],
            ];

            $borrow->update_borrow($borrow_data);
            $storage->update_qty($storage_data);

            $get_borrowed_item = $storage->get_approved_item_requested($selectedItem[$i]);

            foreach($get_borrowed_item as $item_key => $item_val){
                $approved_item[] = '<tr><td style="border: 1px solid black;">'.$item_val->item_name.'</td>
                <td style="border: 1px solid black;">'.$item_val->borrowed_qty.'</td>
                <td style="border: 1px solid black;">'.$selectedQty[$i].'</td>
                <td style="border: 1px solid black;">'.$item_val->purpose.'</td>
                <td style="border: 1px solid black;">'.$item_val->date_returned.'</td></tr>';
            }
        }

        $borrower_details = $account->get_borrower_details($borrower_id);
        
        $mail_subject = $email_conf->subject;

        $body = str_replace("[name]", ucwords(strtolower($borrower_details->borrower_name)), $email_conf->message);
        $body2 = str_replace("[office]", strtoupper($user_details->department), $body);
        $body3 = str_replace("[order_num]", $oder_number, $body2); 
        $str_table_data = implode(", ", $approved_item);
        $clean_row = str_replace(", ", " ", $str_table_data);
        $body4 = str_replace("<tr></tr>", $clean_row, $body3);
        
        $mailer->send_mail($borrower_details->email_address, ucwords(strtolower($borrower_details->borrower_name)), $mail_subject, $body4);

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