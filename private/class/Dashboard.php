<?php 

    class Dashboard {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function count_members(){
            $sql = "SELECT count(member_id) AS members FROM tbl_members";
            $res = $this->db->prepare($sql);
            $res->execute();
            return $res->fetch(PDO::FETCH_OBJ);
        }

        public function count_items(){
            $sql = "SELECT count(item_id) AS items FROM tbl_item";
            $res = $this->db->prepare($sql);
            $res->execute();
            return $res->fetch(PDO::FETCH_OBJ);
        }

        public function count_rooms(){
            $sql = "SELECT count(room_id) AS rooms FROM tbl_room";
            $res = $this->db->prepare($sql);
            $res->execute();
            return $res->fetch(PDO::FETCH_OBJ);
        }
    }