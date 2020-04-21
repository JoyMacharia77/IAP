<?php

define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','btc3205');

class DBConnector{
     public $conn;

     function _construct(){
         $this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die("Error:" .mysqli_error($this->conn));
         mysqli_select_db($this->conn,"btc3205");
     }

     public function closeDatabase(){
         mysqli_close($this->conn);
     }
}

?>