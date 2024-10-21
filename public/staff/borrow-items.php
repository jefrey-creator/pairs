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
    $order_num = time();
    // $order_num = 1729517444;
    $date_created = date_create($date_borrowed->server_time);
    $formatted_date_today = date_format($date_created, "Y-m-d");

    if(!intval($borrower_id) && empty($borrower_id)){

        $result = "You must login first, before borrowing any item/equipment.";

    }else{

        $admin_emails = $account->select_admins();

        for ($i = 0; $i < count($arr_item_uuid); $i++) {
            
            if (empty($arr_item_uuid[$i])) {
    
                $result = "Please select an item first.";
                
            } elseif (empty($arr_item_qty[$i]) || !intval($arr_item_qty[$i]) || intval($arr_item_qty[$i]) < 1) {
    
                $result = "Quantity must be at least 1.";
                
            } elseif (empty($arr_item_return_date[$i])) {
    
                $result = "Expected date of return is required.";
                
            } elseif (empty($arr_purpose[$i])) {
    
                $result = "You must provide a purpose for each requesting item.";
    
            }
            elseif(  $arr_item_return_date[$i] < $formatted_date_today ){
                $result = "Invalid expected date of return.";
            }
            else {

                $table_data = [];
                $borrowing = [];
                $email_conf = $config->set_config("borrow_item");
                $mail_subject = $email_conf->subject;
                
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

                $borrowing = $borrow->add_borrowing($borrow_data);

                $get_borrowed_item = $storage->get_item_requested($borrower_id, $order_num);
                

                foreach($get_borrowed_item as $item_key => $item_val){
                    $table_data[] = '<tr><td style="border: 1px solid black;">'.$item_val->item_name.'</td>
                    <td style="border: 1px solid black;">'.$item_val->borrowed_qty.'</td>
                    <td style="border: 1px solid black;">'.$item_val->purpose.'</td>
                    <td style="border: 1px solid black;">'.$item_val->date_returned.'</td></tr>';
                }
                
                $str_table_data = implode(", ", $table_data);
                $body = str_replace("[name]", $borrower_name, $email_conf->message);
                $body1 = str_replace("[office]", $borrower_office, $body);
                $body2 = str_replace("[contact]", $borrower_contact, $body1);
                $body3 = str_replace("<tr></tr>", str_replace(",", "", $str_table_data) , $body2);
            } 
        }

        foreach($admin_emails as $admin){
            $mailer->send_mail($admin->email_address, $admin->full_name, $mail_subject, $body3);
        }

        if($borrowing === true){
            $result = "The item(s) you want to borrow have been successfully requested. Please hold on while the custodian processes your request. You will receive an email notification once it is approved.";
            $success = true;

        }else{
            $result = "Error connecting database.";
        }
       
    }

    // Return a JSON response
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);