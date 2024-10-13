<?php 

    class Room{
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }
        
        public function get_rooms($offset, $limit){
            $sql = "SELECT * FROM tbl_room ORDER BY room_num ASC LIMIT :offset, :limit";
            $res = $this->db->prepare($sql);
            $res->bindParam(":offset", $offset, PDO::PARAM_INT);
            $res->bindParam(":limit", $limit,  PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function add_room($data){
            $sql = "INSERT INTO tbl_room (room_name, room_num) VALUES (:room_name, :room_num)";
            $res = $this->db->prepare($sql);
            // $res->bindParam(":room_name")
            $res->execute($data);
            return true;
        }

        public function delete_room($room_id){
            $sql = "DELETE FROM tbl_room WHERE room_id = :room_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":room_id", $room_id, PDO::PARAM_INT);
            $res->execute();
            return true;
        }

        public function select_room($room_id){
            $sql = "SELECT * FROM tbl_room WHERE room_id = :room_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":room_id", $room_id, PDO::PARAM_INT);
            $res->execute();
            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_room($data){
            $sql = "UPDATE tbl_room SET room_name = :room_name, room_num = :room_num WHERE room_id = :room_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function dropdown_room(){
            $sql = "SELECT * FROM tbl_room ORDER BY room_name ASC";
            $res = $this->db->prepare($sql);
            $res->execute();
            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_item_by_room($room_id){
            $sql = "
            SELECT  r.room_num,
                    i.item_id, i.item_name, i.item_desc, i.item_brand, i.item_model, i.item_price, i.date_acquired, i.item_uuid, cn.condition,
                    c.cat_name,
                    h.handler_name,
                    s.item_qty
                FROM tbl_room AS r 
                LEFT JOIN tbl_storage AS s ON (r.room_id=s.room_id)
                LEFT JOIN tbl_item AS i ON (s.item_uuid=i.item_uuid)
                LEFT JOIN tbl_category AS c ON (i.item_category=c.cat_id)
                LEFT JOIN tbl_item_handler AS h ON (i.acquired_by=h.handler_id)
                LEFT JOIN tbl_condition AS cn ON (i.condition_id=cn.condition_id)
                WHERE s.room_id = :room_id";

            $res = $this->db->prepare($sql);
            $res->bindParam(":room_id", $room_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_item_by_condition($condition_id){
            $sql = "
            SELECT  r.room_num,
                    i.item_id, i.item_name, i.item_desc, i.item_brand, i.item_model, i.item_price, i.date_acquired, i.item_uuid, cn.condition,
                    c.cat_name,
                    h.handler_name,
                    s.item_qty
                FROM tbl_room AS r 
                LEFT JOIN tbl_storage AS s ON (r.room_id=s.room_id)
                LEFT JOIN tbl_item AS i ON (s.item_uuid=i.item_uuid)
                LEFT JOIN tbl_category AS c ON (i.item_category=c.cat_id)
                LEFT JOIN tbl_item_handler AS h ON (i.acquired_by=h.handler_id)
                LEFT JOIN tbl_condition AS cn ON (i.condition_id=cn.condition_id)
                WHERE i.condition_id = :condition_id";

            $res = $this->db->prepare($sql);
            $res->bindParam(":condition_id", $condition_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_all_item(){
            $sql = "
            SELECT  r.room_num,
                    i.item_id, i.item_name, i.item_desc, i.item_brand, i.item_model, i.item_price, i.date_acquired, i.item_uuid, cn.condition,
                    c.cat_name,
                    h.handler_name,
                    s.item_qty
                FROM tbl_room AS r 
                LEFT JOIN tbl_storage AS s ON (r.room_id=s.room_id)
                LEFT JOIN tbl_item AS i ON (s.item_uuid=i.item_uuid)
                LEFT JOIN tbl_category AS c ON (i.item_category=c.cat_id)
                LEFT JOIN tbl_item_handler AS h ON (i.acquired_by=h.handler_id)
                LEFT JOIN tbl_condition AS cn ON (i.condition_id=cn.condition_id)
                WHERE s.item_uuid = i.item_uuid";
            $res = $this->db->prepare($sql);
            // $res->bindParam(":condition_id", $condition_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

    }