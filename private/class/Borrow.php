<?php 

    class Borrow {

        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function dropdown_item(){

            $sql = "SELECT i.item_name, s.item_uuid, s.item_qty FROM tbl_item AS i
                    LEFT JOIN tbl_storage AS s ON(i.item_uuid=s.item_uuid)
                    WHERE i.condition_id = 1";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function add_borrowing($data){

            $sql = "INSERT INTO tbl_borrow(borrower_id, date_borrowed, date_returned, item_id, borrowed_qty, purpose) 
                    VALUES (:borrower_id, :date_borrowed, :date_returned, :item_id, :borrowed_qty, :purpose)";
            $res = $this->db->prepare($sql);
            foreach($data as $row){
                $res->execute($row);
            }
            return true;
        }

        public function get_server_time(){

            $sql = "SELECT NOW() AS server_time";
            $res = $this->db->prepare($sql);
            $res->execute();

            return $res->fetch(PDO::FETCH_OBJ);
        }
    }