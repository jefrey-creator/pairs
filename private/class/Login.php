<?php

    class Login{
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function user_login($username, $password){

            $sql = "SELECT acct_id, username, password, user_type, acct_status, login_token FROM tbl_acct WHERE username = :username";
            $res = $this->db->prepare($sql);
            $res->bindParam(':username', $username, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() == 1){
                $row = $res->fetch(PDO::FETCH_OBJ);
                if(password_verify($password, $row->password)){
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }

        }

        public function get_user_logged_in($username){
            
            $sql = "SELECT  a.acct_id, a.username, a.password, a.user_type, a.acct_status, a.login_token, a.reset_token, a.reg_token, a.acct_uuid,
                            CONCAT(m.f_name, ' ', m.m_name, ' ', m.l_name) as full_name, m.contact,
                            d.department
            FROM tbl_acct AS a
            LEFT JOIN tbl_members AS m ON (a.acct_uuid=m.act_id)
            LEFT JOIN tbl_department AS d ON (m.department=d.department_id)
            WHERE a.username = :username";
            $res = $this->db->prepare($sql);
            $res->bindParam(':username', $username, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() == 1){
                return $res->fetch(PDO::FETCH_OBJ);
            }
        }

        public function update_login_token($data){

            $sql = "UPDATE tbl_acct SET login_token = :jwt WHERE acct_id = :acct_id";
            $res = $this->db->prepare($sql);
            
            $res->execute($data);

            return true;
        }
    }