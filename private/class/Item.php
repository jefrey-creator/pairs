<?php 

    class Item {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function add_item_condition($condition){

            $sql = "INSERT INTO tbl_condition (`condition`) VALUES (:condition)";
            $res = $this->db->prepare($sql);
            $res->bindParam(':condition', $condition, PDO::PARAM_STR);
            $res->execute();

            return true;
        }


        public function get_item_condition($offset, $limit){
            $sql = "SELECT * FROM tbl_condition ORDER BY `condition` ASC LIMIT :offset, :limits";
            $res = $this->db->prepare($sql);
            $res->bindParam(':offset', $offset, PDO::PARAM_INT);
            $res->bindParam(':limits', $limit, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function get_item_condition_by_id($id){

            $sql = "SELECT * FROM tbl_condition WHERE condition_id = :id";
            $res = $this->db->prepare($sql);
            $res->bindParam(':id', $id, PDO::PARAM_INT);

            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function update_condition($data){
            
            $sql = "UPDATE tbl_condition SET `condition` = :condition WHERE condition_id = :id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function dropdown_condition(){
            $sql = "SELECT * FROM tbl_condition ORDER BY `condition` ASC";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function add_item($data){
            $sql = "INSERT INTO tbl_item 
                            (item_name, item_desc, item_brand, item_model, item_price, item_category, item_type, condition_id, acquired_by, date_acquired, item_uuid)
                                VALUES 
                            (:item_name, :item_desc, :item_brand, :item_model, :item_price, :item_category, :item_type, :condition_id, :acquired_by, :date_acquired, :item_uuid)";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function select_item_by_id($item_id){
            $sql = "SELECT  r.room_id,
                    i.item_id, i.item_name, i.item_desc, i.item_brand, i.item_model, i.item_price, i.date_acquired, i.item_uuid, i.condition_id, i.item_category, i.item_type,
                    h.handler_id,
                    s.item_qty
                FROM tbl_room AS r 
                LEFT JOIN tbl_storage AS s ON (r.room_id=s.room_id)
                LEFT JOIN tbl_item AS i ON (s.item_uuid=i.item_uuid)
                LEFT JOIN tbl_category AS c ON (i.item_category=c.cat_id)
                LEFT JOIN tbl_item_handler AS h ON (i.acquired_by=h.handler_id)
                WHERE i.item_id = :item_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":item_id", $item_id, PDO::PARAM_INT);
            $res->execute();
            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_item($data){
            $sql = "UPDATE tbl_item SET 
                            item_name = :item_name, 
                            item_desc = :item_desc, 
                            item_brand = :item_brand,
                            item_model = :item_model, 
                            item_price = :item_price, 
                            item_category = :item_category, 
                            item_type = :item_type, 
                            condition_id = :condition_id, 
                            acquired_by = :acquired_by, 
                            date_acquired = :date_acquired
                            WHERE item_uuid = :item_uuid";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function delete_item_by_uuid($uuid){
            $sql = "DELETE FROM tbl_item WHERE item_uuid = :uu_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":uu_id", $uuid, PDO::PARAM_STR);
            $res->execute();
            return true;
        }

        public function get_item_old_data($item_uuid){
            $sql = "SELECT * FROM tbl_item WHERE item_uuid = :item_uuid";
            $res = $this->db->prepare($sql);
            $res->bindParam(":item_uuid", $item_uuid, PDO::PARAM_STR);
            $res->execute();
            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }
    }