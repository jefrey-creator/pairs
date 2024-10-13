<?php 

    class Category {
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function load_category($offset, $limit){
            $sql = "SELECT * FROM tbl_category ORDER BY cat_name ASC LIMIT :offset, :limit";
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

        public function add_category($cat_name){
            $sql = "INSERT INTO tbl_category (cat_name) VALUES (:cat_name)";
            $res = $this->db->prepare($sql);
            $res->bindParam(":cat_name", $cat_name, PDO::PARAM_STR);
            $res->execute();
            return true;
        }

        public function select_category($cat_id) {
            $sql = "SELECT * FROM tbl_category WHERE cat_id = :cat_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0 ){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_category($data){
            $sql = "UPDATE tbl_category SET cat_name = :cat_name WHERE cat_id = :cat_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);

            return true;
        }

        public function delete_category($cat_id){
            $sql = "DELETE FROM tbl_category WHERE cat_id = :cat_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }

        public function category_dropdown(){
            $sql = "SELECT * FROM tbl_category ORDER BY cat_name ASC";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }
    }