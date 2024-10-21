<?php 

    include_once 'auth.php';
    header("Content-Type: application/json");

    $borrow = new Borrow();
    $mailer = new Mailer();
    $config = new Config();
    $storage = new Storage();
    $account = new Account();
    
    $result = "";
    $success = false;

    $borrower_id = $decoded->data->acct_id;
    $borrower_name = $user_details->full_name;
    $borrower_office = $user_details->department;
    $borrower_contact = $user_details->contact;
    $arr_item_uuid = $_POST['arr_item_uuid'];
    $arr_item_qty = $_POST['arr_item_qty'];
    $arr_item_return_date = $_POST['arr_item_return_date'];
    $arr_purpose = $_POST['arr_purpose'];
    $date_borrowed = $borrow->get_server_time();
    // $order_num = time();
    $order_num = 1729488077;

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
                        "order_num" => $order_num,
                    ],
                ];

                $get_borrowed_item = $storage->get_item_requested($borrower_id, $order_num);
                $item_name = [];
                $item_qty = [];
                $item_purpose = [];
                $item_returned = [];

                $email_ad = [];
                $admin_name = [];
                $admin_emails = $account->select_admins();

                $table_data = [];
                $email_conf = $config->set_config("borrow_item");
                $subject = $email_conf->subject;

                $message = "";

                foreach($get_borrowed_item as $item){

                    $item_name[] = $item->item_name;
                    $item_qty[] = $item->borrowed_qty;
                    $item_purpose[] = $item->purpose;
                    $item_returned[] = $item->date_returned;

                    
                    $table_data[] = '<td style="border: 1px solid black;">'.$item->item_name.'</td>
                                        <td style="border: 1px solid black;">'.$item->borrowed_qty.'</td>
                                        <td style="border: 1px solid black;">'.$item->purpose.'</td>
                                        <td style="border: 1px solid black;">'.$item->date_returned.'</td>';
                    // $body = str_replace("[item]", $item->item_name,  $email_conf->message);
                    // $body1 = str_replace("[qty]", $item->borrowed_qty, $body);

                    
                    $body = str_replace("[name]", $borrower_name, $email_conf->message);
                    $body1 = str_replace("[office]", $borrower_office, $body);
                    $body2 = str_replace("[contact]", $borrower_contact, $body1);
                    // $body3 = str_replace("<tr></tr>",  $table_data, $body2);
                }     

                // $message = str_replace("<tr></tr>", $table_data, $body2);
                
                

                // foreach($admin_emails as $admin){
                //     $email_ad[] = $admin->email_address;
                //     $admin_name[] = $admin->full_name;
                //     $mailer->send_mail($admin->email_address, $admin->full_name, $subject, $body6);
                // }

                // for ($item=0; $item < count($admin_emails); $item++) {
                //     $mailer->send_mail($admin_emails[$i]->email_address, $admin_emails[$i]->full_name, $subject, $body6);
                // }

                // $mailer->send_mail(, , $subject, $body6);
                
                

                // if($borrow->add_borrowing($borrow_data) === true){
                //     $result = "Your item(s) have been successfully requested. Please hold on while the custodian processes your request. You will receive an email notification once it is approved.";
                //     $success = true;
                // }else{
                //     $result = "Error connecting database.";
                // }
            }
        }
    }

    // Return a JSON response
    echo json_encode([
        "success" => $success,
        "result" => $table_data
    ]);