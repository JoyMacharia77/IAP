<?php
include "crud.php";

class User implements Crud{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    function _construct( $first_name, $last_name, $city_name){
       $this-> first_name =  $first_name;
       $this-> last_name =  $last_name;
       $this-> city_name =  $city_name;
    }

    //userID setter
    public function setUserId($user_id){
        $this->user_id=$user_id;
    }

    public function getUserId(){
        // return $this->$user_id;
           return $this->user_id;
    }

    public function save(){

        $this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die("Error:" .mysqli_error($this->conn));
        mysqli_select_db ($this->conn, "btc3205");
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        //$res = mysqli_query($this->conn,"INSERT INTO user_table(first_name,last_name,user_city) VALUES('$fn,'$ln','$city')")or die("Error" .mysqli_error($this->conn));
        $res = ("INSERT INTO user_table(first_name,last_name,user_city) VALUES('$fn,'$ln','$city')")or die("Error" .mysqli_error($this->conn));
        // $query= mysqli_query($this->conn,$res);
        mysqli_query($this->conn,$res);
        return $res;
       // return $query;
    }

    public function readAll(){
        return null;
    }
    public function readUnique(){
        return null;
    }
    public function search(){
        return null;
    }
    public function update(){
        return null;
    }
    public function removeOne(){
        return null;
    }
    public function removeAll(){
        return null;
    }
}

?>