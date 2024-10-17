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
    }