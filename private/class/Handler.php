<?php 

    class Handler {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function view_handler($offset, $limit){
            
            $sql = "SELECT *  FROM tbl_item_handler ORDER BY handler_name LIMIT :offset, :limit";
            $res = $this->db->prepare($sql);
            $res->bindParam(":offset", $offset, PDO::PARAM_INT);
            $res->bindParam(":limit", $limit, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }


        public function add_handler($h_name){

            $sql = "INSERT INTO tbl_item_handler (handler_name) VALUES (:handler)";

            $res = $this->db->prepare($sql);
            $res->bindParam(":handler", $h_name, PDO::PARAM_STR);
            $res->execute();

            return true;
        }

        public function select_handler($handler_id) {
            $sql = "SELECT * FROM tbl_item_handler WHERE handler_id = :handler_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":handler_id", $handler_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_handler($data){
            $sql = "UPDATE tbl_item_handler SET handler_name = :handler_name WHERE handler_id = :handler_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function delete_handler($handler_id) {
            $sql = "DELETE FROM tbl_item_handler WHERE handler_id = :handler_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":handler_id", $handler_id, PDO::PARAM_INT);
            $res->execute();

           return true;
        }

        public function dropdown_handler(){
            $sql = "SELECT * FROM tbl_item_handler ORDER BY handler_name ASC";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

    }