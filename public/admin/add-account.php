<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $account = new Account();

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

    $uu_id = md5(uniqid().time());
    $pattern = '/^[a-zA-Z0-9!@#$%^&*()]*$/';

    if(empty($acct_id)){

        if($account->duplicate_username(strtolower($username)) === true){
            $result = "Username already exist.";
        }elseif(empty($username) || strlen($username) <= 3){
            $result = "Username can't be empty and minimum of 3 characters long.";
        }elseif(strlen($password) <= 8){
            $result = "Password must be at least 8 characters long.";
        }elseif(!preg_match($pattern, $password)){
            $result = "Password should be a combination of: UPPERCASE | lowercase | Number | Symbol";
        }elseif(empty($member_type) || ($member_type > 2 && $member_type <= 0)){
            $result = "Invalid borrower type selected.";
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
            ];
    
            $acct_data = [
                "username" => strtolower($username), 
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "user_type" => $user_type, 
                "acct_uuid" => $uu_id, 
            ];

            if($account->add_account($acct_data) === true){
                if($account->add_member($member_data) === true){
                    $result = "Account successfully added.";
                    $success = true;
                }else{
                    $result = "Profile not save";
                }
            }else{
                $result = "Account & Profile not save";
            }
        }
    }else{

        if(empty($member_type) || ($member_type > 2 && $member_type <= 0)){
            $result = "Invalid borrower type selected.";
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


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);