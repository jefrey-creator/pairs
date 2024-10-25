<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();
    $config = new Config();
    $account = new Account();
    $mailer = new Mailer();
    $logs = new Logs();

    $success = false;
    $result = "";

    $selectedItem = $_POST['selectedItem'];
    $reason = trim($_POST['reason']);
    $order_number = trim($_POST['order_number']);
    $borrower_id = trim($_POST['borrower_id']);

    $borrower_details = $account->get_borrower_details($borrower_id);

    $email_conf = $config->set_config("req_denied");
    $mail_subject = $email_conf->subject;
    $body = str_replace("[name]", ucwords(strtolower($borrower_details->borrower_name)), $email_conf->message);
    $body2 = str_replace("[order_num]", $order_number, $body);
    $body3 = str_replace("[reason]", $reason, $body2);

    if(!isset($_POST['selectedItem'])){

        $result = "Select an item first.";

    }elseif(empty($reason) || strlen($reason) < 10){

        $result = "Reason must be atleast 10 characters long.";

    }
    else{
        $success = true;
        $result = "Requested item has been declined.";
    }


    if($success === true){

        for ($i=0; $i < count($selectedItem); $i++) { 

            $borrow_data = [
                [
                    "status" => 5,
                    "borrow_id" => $selectedItem[$i],
                    "approved_qty" => 0
                ],
            ];

            $borrow->update_borrow($borrow_data);

        }

        $mailer->send_mail($borrower_details->email_address, ucwords(strtolower($borrower_details->borrower_name)), $mail_subject, $body3);
        echo json_encode(
           [
                "success" => $success,
                "result" => $result
           ]
        );


    }else{
        echo json_encode(
            [
                "success" => $success,
                "result" => $result
            ]
        );

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Decline Item Request", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[Reference Number:" .$order_number. "][Success: "  . $success. "][Reason: ".$reason."]"
    ];

    $logs->insert_log($act_data);