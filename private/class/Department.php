<?php 

    class Department{
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function view_department(){
            $sql = "SELECT * FROM tbl_department ORDER BY department ASC";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function add_department($data){

            $sql = "INSERT INTO tbl_department (department_head, department) VALUES (:department_head, :department)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function update_department($data){

            $sql = "UPDATE tbl_department  SET department_head = :department_head, department = :department WHERE department_id = :department_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function select_department_by_id($id){
            $sql = "SELECT * FROM tbl_department WHERE department_id = :id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":id", $id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function delete_department($id){
            $sql = "DELETE FROM tbl_department WHERE department_id = :id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":id", $id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }
    }