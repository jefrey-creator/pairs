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
    

    $email_conf = $config->set_config("item_delivered");
    

    if(!isset($_POST['selectedItem'])){

        $result = "Select an item first.";

    }else{
        $result = "Selected item was successfully delivered to the client.";
        $success = true;

    }

    if($success === true){

        $approved_item = [];

        for($i = 0; $i < count($selectedItem); $i++){

            $borrow_data = [
                [
                    "status" => 3,
                    "borrow_id" => $selectedItem[$i],
                    "approved_qty" => $selectedQty[$i]
                ],
            ];

            $borrow->update_borrow($borrow_data);

            $get_borrowed_item = $storage->get_approved_item_requested($selectedItem[$i]);

            foreach($get_borrowed_item as $item_key => $item_val){
                $approved_item[] = '<tr><td style="border: 1px solid black;">'.$item_val->item_name.'</td>
                <td style="border: 1px solid black;">'.$item_val->borrowed_qty.'</td>
                <td style="border: 1px solid black;">'.$item_val->approved_qty.'</td>
                <td style="border: 1px solid black;">'.$item_val->date_returned.'</td></tr>';
            }
        }

        $borrower_details = $account->get_borrower_details($borrower_id);
        
        $mail_subject = $email_conf->subject;

        $body = str_replace("[name]", ucwords(strtolower($borrower_details->borrower_name)), $email_conf->message);
        $body2 = str_replace("[order_num]", $oder_number, $body);
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