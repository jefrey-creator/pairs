<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";

    $account = new Account();
    $logs = new Logs();

    $user_type = trim($_POST['user_type']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $member_type = trim($_POST['member_type']);
    $id_number = trim($_POST['id_number']);
    $sex = trim($_POST['sex']);
    $f_name = trim($_POST['f_name']);
    $m_name = trim($_POST['m_name']);
    $l_name = trim($_POST['l_name']);
    $yr_level = ($member_type == 2) ? NULL : trim($_POST['yr_level']);
    $contact = trim($_POST['contact']);
    $department = trim($_POST['department']);
    $acct_id = trim($_POST['acct_id']);
    $email = trim($_POST['email']);

    $uu_id = md5(uniqid().time());
    $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';

    if(empty($acct_id)){

        if($account->duplicate_username(strtolower($username)) === true){
            $result = "Username already exist.";
        }elseif($account->duplicate_email($email) === true ) {
            $result = "Email address already exist.";
        }
        elseif(empty($username) || strlen($username) <= 3){
            $result = "Username can't be empty and minimum of 3 characters long.";
        }elseif(strlen($password) <= 8){
            $result = "Password must be at least 8 characters long.";
        }elseif(!preg_match($pattern, $password)){
            $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
        }elseif(empty($member_type) || ($member_type > 2 && $member_type <= 0)){
            $result = "Invalid borrower type selected.";
        }elseif(empty($id_number)){
            $result = "ID number is required.";
        }elseif ($sex > 1 && $sex < 0) {
            $result = "Invalid sex preference selected.";
        }elseif (empty($f_name) || strlen($f_name) < 2) {
            $result = "First name must be at least 2 characters long.";
        }elseif (empty($l_name) || strlen($l_name) < 2) {
            $result = "Last name must be at least 2 characters long.";
        }elseif(empty($contact)){
            $result = "Contact number is required.";
        }elseif(empty($department)){
            $result = "Please select a department.";
        }elseif(empty($user_type)){
            $result = "Please select a user type.";
        }elseif(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = "Invalid email address.";
        }
        else{

            $member_data = [
                "act_id" =>  $uu_id, 
                "id_number" => $id_number, 
                "member_type" => $member_type, 
                "f_name" => ucwords(strtolower($f_name)), 
                "m_name" => ucwords(strtolower($m_name)),
                "l_name" => ucwords(strtolower($l_name)), 
                "sex" => $sex, 
                "department" => $department, 
                "contact" => $contact, 
                "yr_level" => $yr_level,
                "email_address" => $email
            ];
    
            $acct_data = [
                "username" => strtolower($username), 
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "user_type" => $user_type, 
                "acct_uuid" => $uu_id, 
            ];

            $config = new Config();
            $conf = $config->set_config("acct_created");
            $subject = $conf->subject;
            $body = $conf->message;
            $body1 = str_replace("[name]", $f_name, $body);
            $body2 = str_replace("[username]", $username, $body1);
            $body3 = str_replace("[password]", $password, $body2);

            $mailer = new Mailer();
            
            if($account->add_account($acct_data) === true){
                if($account->add_member($member_data) === true){
                   
                    if($mailer->send_mail($email, $f_name, $subject, $body3) === true){
                        $result = "Account successfully added.";
                        $success = true;
                    }else{
                        $result = "Failed to send email notification but the account successfully created.";
                    }    
                }else{
                    $result = "Profile not save";
                }
            }else{
                $result = "Account & Profile not save";
            }
        }
    }else{

        $verify_email = $account->verify_uuid($email);

        if(empty($member_type) || ($member_type > 2 && $member_type <= 0)){
            $result = "Invalid borrower type selected.";
        }elseif(($account->duplicate_email($email) === true AND $verify_email->act_id != $acct_id)) {
            $result = "Email address already exist.";
        }elseif(empty($id_number)){
            $result = "ID number is required.";
        }elseif(empty($sex)){
            $result = "Please select a gender preference.";
        }elseif ($sex > 1 && $sex < 0) {
            $result = "Invalid sex preference selected.";
        }elseif (empty($f_name) || strlen($f_name) < 2) {
            $result = "First name must be at least 2 characters long.";
        }elseif (empty($l_name) || strlen($l_name) < 2) {
            $result = "Last name must be at least 2 characters long.";
        }elseif(empty($contact)){
            $result = "Contact number is required.";
        }elseif(empty($department)){
            $result = "Please select a department.";
        }elseif(empty($user_type)){
            $result = "Please select a user type.";
        }else{

            $member_data = [
                "act_id" => $acct_id, 
                "id_number" => $id_number, 
                "member_type" => $member_type, 
                "f_name" => ucwords(strtolower($f_name)), 
                "m_name" => ucwords(strtolower($m_name)),
                "l_name" => ucwords(strtolower($l_name)), 
                "sex" => $sex, 
                "department" => $department, 
                "contact" => $contact, 
                "yr_level" => $yr_level,
                "email_address" => $email
            ];
    
            $acct_data = [
                "user_type" => $user_type, 
                "acct_uuid" => $acct_id, 
            ];

            if($account->update_account($acct_data) === true){
                if($account->update_member($member_data) === true){
                    $result = "Account successfully updated.";
                    $success = true;
                }else{
                    $result = "Profile not updated";
                }
            }else{
                $result = "Account & Profile not updated";
            }
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (!empty($acct_id)) ? "Update user account" : "Add user account", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (!empty($acct_id)) ? $result . "[ID: ".$acct_id."][Success: ".$success."]" : $result . "[Data: ". $email ."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);
    


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);