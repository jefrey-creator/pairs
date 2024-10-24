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
                    WHERE i.condition_id = 1 AND s.item_qty > 0";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function add_borrowing($data){

            $sql = "INSERT INTO tbl_borrow(borrower_id, date_borrowed, date_returned, item_id, borrowed_qty, purpose, order_num) 
                    VALUES (:borrower_id, :date_borrowed, :date_returned, :item_id, :borrowed_qty, :purpose, :order_num)";
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

        public function dropdown_status(){
            $sql = "SELECT status FROM tbl_borrow";
            $res = $this->db->prepare($sql);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fethAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }


        public function borrowed_item_by_order_num($borrower_id, $status){

            $sql = "SELECT 
                            `order_num`, 
                            COUNT(`borrow_id`) AS total_borrows,
                            MAX(`date_borrowed`) AS last_borrowed_date, 
                            SUM(`borrowed_qty`) AS total_qty
                        FROM 
                            `tbl_borrow` 
                        WHERE 
                            `borrower_id` = :borrower_id AND status = :status
                        GROUP BY 
                            `order_num`
                        ORDER BY 
                            last_borrowed_date DESC";
            $res = $this->db->prepare($sql);
            $res->bindParam(":borrower_id", $borrower_id, PDO::PARAM_INT);
            $res->bindParam(":status", $status, PDO::PARAM_INT);
            $res->execute();


            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }

        }

        public function list_borrowed_items($order_num){
            $sql = "select i.item_name, b.borrowed_qty, b.status FROM tbl_borrow AS b 
                    LEFT JOIN tbl_item AS i ON (b.item_id=i.item_uuid) WHERE b.order_num = :order_num";
            $res = $this->db->prepare($sql);
            $res->bindParam(":order_num", $order_num, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function count_borrowed_item($status){
            
            $sql = "SELECT distinct(order_num) FROM tbl_borrow WHERE status = :status";
            $res = $this->db->prepare($sql);
            $res->bindParam(":status", $status, PDO::PARAM_INT);
            $res->execute();

            return $res->rowCount();
        }

        public function view_borrowed_item($order_num, $status){
            $sql = "SELECT 	i.item_name, i.item_uuid, i.item_id,
                            b.purpose, b.date_returned, b.date_borrowed, b.borrowed_qty, b.order_num, b.borrow_id, b.borrower_id, b.approved_qty,
                            CONCAT(m.f_name, ' ', m.m_name, ' ', m.l_name) as borrower_name,
                            s.item_qty
                    FROM tbl_item         AS i 
                    LEFT JOIN tbl_borrow  AS b ON (i.item_uuid=b.item_id)
                    LEFT JOIN tbl_acct    AS a ON (b.borrower_id=a.acct_id)
                    LEFT JOIN tbl_members AS m ON (a.acct_uuid=m.act_id)
                    LEFT JOIN tbl_storage AS s ON (i.item_uuid=s.item_uuid)
                    WHERE b.order_num = :order_num AND b.status = :status
                    ORDER BY b.date_borrowed DESC";
            $res = $this->db->prepare($sql);
            $res->bindParam(":order_num", $order_num, PDO::PARAM_INT);
            $res->bindParam(":status", $status, PDO::PARAM_INT);
            $res->execute();

            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function order_number($status){
            $sql = "SELECT 
                            `order_num`, 
                            COUNT(`borrow_id`) AS total_borrows,
                            MAX(`date_borrowed`) AS last_borrowed_date, 
                            SUM(`borrowed_qty`) AS total_qty
                    FROM 
                        `tbl_borrow` 
                    WHERE 
                        `status` = :status
                    GROUP BY 
                        `order_num`
                    ORDER BY 
                            last_borrowed_date DESC";
            $res = $this->db->prepare($sql);
            $res->bindParam(":status", $status, PDO::PARAM_INT);
            $res->execute();


            if($res->rowCount() > 0){
                return $res->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }

        public function update_borrow($data){

            $sql = "UPDATE tbl_borrow SET status = :status, approved_qty = :approved_qty WHERE borrow_id = :borrow_id";
            $res = $this->db->prepare($sql);
            foreach($data as $row){
                $res->execute($row);
            }

            return true;
        }
    }