<?php 

    class Database_Connection {

        public $server  = "localhost";
        public $user    = "root";
        public $password;
        public $dbname  = "dbname_eagblogge";
        public $charset = "utf8";
     

        public function getConnect() {
        
        try{

                $dsn = "mysql:host=".$this->server.";dbname=".$this->dbname.";charset=".$this->charset;
                $pdo  = new PDO($dsn, $this->user, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $pdo;

    
            } catch (PDOException $e) {
                    die("Connection Error : " . $e->getMessage()) ;
                        exit();
            }
        }
    }

    


?>