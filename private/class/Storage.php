<?php 

    class Storage {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function store_item($data){
            $sql = "INSERT INTO tbl_storage (room_id, item_uuid, item_qty) VALUES (:room_id, :item_uuid, :item_qty)";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function update_stored_item($data){
            $sql = "UPDATE tbl_storage SET room_id = :room_id, item_qty = :item_qty WHERE item_uuid = :item_uuid";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function delete_stored_item($uuid){
            $sql = "DELETE FROM tbl_storage WHERE item_uuid = :uu_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uu_id", $uuid, PDO::PARAM_STR);
            $res->execute();
            return true;
        }

        public function get_item_requested($borrower_id, $order_num) {
            $sql = "SELECT  i.item_name, i.item_uuid,
                            b.borrowed_qty, b.date_returned, b.purpose
                    FROM  tbl_item AS i 
                    LEFT JOIN tbl_borrow AS b ON (i.item_uuid=b.item_id)
                    WHERE b.borrower_id = :borrower_id AND b.status = 1 AND b.order_num = :order_num";
            $res = $this->db->prepare($sql);
            $res->bindParam(":borrower_id", $borrower_id, PDO::PARAM_STR);
            $res->bindParam(":order_num", $order_num, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }
    }