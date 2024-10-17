<?php

    class Config {
        
        private $db;

        public function __construct(){
            $database = new Database();
            $this->db = $database->dbConnect();
        }

        public function add_config($data){
            $sql = "INSERT INTO tbl_email_config (tag, `message`, `subject`) VALUES (:tag, :message, :subject)";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function view_config(){
            $sql = "SELECT * FROM tbl_email_config";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function select_config($id){
            $sql = "SELECT * FROM tbl_email_config WHERE config_id = :config_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":config_id", $id, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }


        public function update_config($data){
            $sql = "UPDATE tbl_email_config SET `message` = :message, `subject` = :subject WHERE config_id = :config_id";
            $res = $this->db->prepare($sql);
            $res->execute($data);
            return true;
        }

        public function delete_config($id){
            
            $sql = "DELETE FROM tbl_email_config WHERE config_id = :config_id";
            $res = $this->db->prepare($sql);
            $res->bindParam(":config_id", $id, PDO::PARAM_INT);
            $res->execute();

            return true;
        }

        public function set_config($tag){
            $sql = "SELECT * FROM tbl_email_config WHERE tag = :tag";
            $res = $this->db->prepare($sql);
            $res->bindParam(":tag", $tag, PDO::PARAM_STR);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }
    }