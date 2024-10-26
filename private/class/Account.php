<?php 

    class Account {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function duplicate_username($username){
            $sql = "SELECT username FROM tbl_acct WHERE username = :username";
            $res = $this->db->prepare($sql);
            $res->bindParam(":username", $username, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function duplicate_email($email){
            
            $sql = "SELECT email_address FROM tbl_members WHERE email_address = :email";
            $res = $this->db->prepare($sql);
            $res->bindParam(":email", $email, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        public function verify_uuid($email){
            
            $sql = "SELECT act_id, email_address FROM tbl_members WHERE email_address = :email";
            $res = $this->db->prepare($sql);
            $res->bindParam(":email", $email, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function add_account($data){
            $sql = "INSERT INTO tbl_acct (username, password, user_type, acct_uuid) VALUES (:username, :password, :user_type, :acct_uuid)";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function add_member($data){
            $sql = "INSERT INTO tbl_members (email_address, act_id, id_number, member_type, f_name, m_name, l_name, sex, department, contact, yr_level) 
            VALUES (:email_address, :act_id, :id_number, :member_type, :f_name, :m_name, :l_name, :sex, :department, :contact, :yr_level)";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function select_all_user(){
            $sql = "SELECT 
                            a.username, a.user_type, a.acct_status, a.acct_uuid, a.acct_id,
                            m.id_number, m.member_type, m.f_name, m.m_name, m.l_name, m.sex, m.contact, m.yr_level,
                            d.department
                    FROM  tbl_acct AS a
                    LEFT JOIN tbl_members AS m ON (a.acct_uuid=m.act_id)
                    LEFT JOIN tbl_department AS d ON (m.department=d.department_id)
                    ORDER BY m.l_name ASC
                    ";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0) {
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_user_by_id($id){
            $sql = "SELECT 
                            a.username, a.user_type, a.acct_status, a.acct_uuid, a.acct_id,
                            m.id_number, m.member_type, m.f_name, m.m_name, m.l_name, m.sex, m.contact, m.yr_level, m.email_address,
                            d.department_id, d.department
                    FROM  tbl_acct AS a
                    LEFT JOIN tbl_members AS m ON (a.acct_uuid=m.act_id)
                    LEFT JOIN tbl_department AS d ON (m.department=d.department_id)
                    WHERE a.acct_uuid = :id
                    ";
            $res = $this->db->prepare($sql);
            $res->bindParam(":id", $id, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0) {
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_account($data){
            $sql = "UPDATE tbl_acct SET user_type = :user_type  WHERE acct_uuid =:acct_uuid";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function update_member($data){
            $sql = "UPDATE tbl_members  
                    SET id_number = :id_number, 
                    member_type = :member_type, 
                    f_name = :f_name, 
                    m_name = :m_name, 
                    l_name = :l_name, 
                    sex = :sex, 
                    department = :department, 
                    contact = :contact, 
                    yr_level = :yr_level,
                    email_address = :email_address
            WHERE  act_id = :act_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function block_user($data){

            $sql = "UPDATE tbl_acct SET acct_status = :acct_status WHERE acct_id = :acct_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function reset_password($data){
            $sql = "UPDATE tbl_acct SET password = :password WHERE acct_id = :acct_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function select_admins(){
            $sql = "SELECT  m.email_address, CONCAT(m.f_name, ' ', m.l_name) as full_name FROM tbl_members AS m 
                            LEFT JOIN tbl_acct AS a ON (m.act_id=a.acct_uuid)
                            WHERE a.user_type = 2";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_user_by_acct_id($acct_id){
            $sql = "SELECT 
                            a.username, a.user_type, a.acct_status, a.acct_uuid, a.acct_id,
                            m.id_number, m.member_type, m.f_name, m.m_name, m.l_name, m.sex, m.contact, m.yr_level, m.email_address,
                            d.department_id
                    FROM  tbl_acct AS a
                    LEFT JOIN tbl_members AS m ON (a.acct_uuid=m.act_id)
                    LEFT JOIN tbl_department AS d ON (m.department=d.department_id)
                    WHERE a.acct_uuid = :id
                    ";
            $res = $this->db->prepare($sql);
            $res->bindParam(":id", $id, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0) {
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function get_borrower_details($borrower_id){
            $sql = "SELECT CONCAT(m.f_name, ' ', m.m_name, ' ', m.l_name) as borrower_name, m.email_address,
                            d.department
                     FROM tbl_members AS m
                    LEFT JOIN tbl_acct AS a ON (m.act_id=a.acct_uuid)
                    LEFT JOIN tbl_borrow AS b ON (a.acct_id=b.borrower_id)
                    LEFT JOIN tbl_department AS d ON (m.department=d.department_id)
                    WHERE b.borrower_id = :borrower_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":borrower_id", $borrower_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0) {
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function change_password($acct_uuid, $password){

            $sql = "UPDATE tbl_acct SET password = :password WHERE acct_uuid = :acct_uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":password", $password, PDO::PARAM_STR);
            $res->bindParam(":acct_uuid", $acct_uuid, PDO::PARAM_STR);
            $res->execute();

            return true;

        }

    }