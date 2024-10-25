<?php 

    class Logs {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }


        public function insert_log($data){

            $sql = "INSERT INTO tbl_logs (user_id, action, ip_address, details) VALUES (:user_id, :action, :ip_address, :details)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function list_logs($offset, $itemPerPage){

            $sql = "SELECT * FROM tbl_logs ORDER BY time_stamp DESC LIMIT :offset, :itemPerPage";
            $res = $this->db->prepare($sql);
            $res->bindParam(":offset", $offset, PDO::PARAM_INT);
            $res->bindParam(":itemPerPage", $itemPerPage, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function filter_logs($data){
            $sql = "SELECT * FROM `tbl_logs` WHERE time_stamp LIKE :date";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }
    }