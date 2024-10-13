<?php

    class Database {

        private $db;

		private $host;
		private $name;
		private $user;
		private $password;

        public function __construct(){

            try {

                $this->host = DB_HOST;
                $this->name = DB_NAME;
                $this->user = DB_USER;
                $this->password = DB_PASS;
                $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name;

                $this->db = new PDO($dsn, $this->user, $this->password);
                
                // set the PDO error mode to exception
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";

              } catch(PDOException $e) {
                
                echo "Connection failed: " . $e->getMessage();

              }
        
        }


        public function dbConnect(){
            return $this->db;
        }

    }