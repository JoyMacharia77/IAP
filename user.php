<?php

include "Crud.php";
include "authenticator.php"; //LAB2
include_once "DBConnector.php";

class User implements Crud{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    //LAB2
    private $username;
    private $password;

    function _construct( $first_name, $last_name, $city_name,$username, $password)
    {
       $this-> first_name =  $first_name;
       $this-> last_name =  $last_name;
       $this-> city_name =  $city_name;
       $this-> username =  $username;
       $this-> password =  $password;

    }

    public static function create () //LAB2
    {
      $instance = new self();
       return $instance;
    }
     //username setter
      public function setUsername($username)
      {
        $this->username= $username;
      }
      //username getter
      public function getUsername()
      {
        return $this->username;
      }
      //password setter
      public function setPassword($password)
      {
          $this->password = $password;
      }
      //password getter
      public function getPassword()
      {
          return $this->password;
      }


      //userID setter
    public function setUserId($user_id)//LAB1
    {
        $this->user_id= $user_id;
    }

    public function getUserId()
    {
         return $this-> user_id;
          // return $this->user_id;
    }

    public function save()
    {
        $con = new DBConnector();

        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname = $this -> username;
        $this->hashPassword();
        $pass = $this ->password;
        $image = $this ->image;
        //LAB3
        $timeZoneOffset = $this -> time_stamp;
        $utcTimeStamp = $this -> offset;
        $res = mysqli_query($con->conn, ("INSERT INTO user_table(first_name, last_name, user_city,username,password,image,time_stamp,offset)
         VALUES('$fn','$ln','$city','$uname','$pass','$image',' $timeZoneOffset',' $utcTimeStamp')") or die("Error : " .mysqli_error($con->conn)));

	  	$con->closeDatabase();
		  return $res;
    }

    public function readAll()
    {
        $con = new DBConnector();
        $res = mysqli_query($con->conn, "SELECT * FROM user_table");

        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo " " .$row['id']. " " .$row['first_name']. " " .$row['last_name']. " " .$row['user_city']." " .$row['username'];
            }
        }
        else {
            echo "The Database is Empty";
        }
        $con->closeDatabase();
    }

    public function readUnique()
    {
        return null;
    }
    public function search()
    {
        return null;
    }
    public function update()
    {
        return null;
    }
    public function removeOne()
    {
        return null;
    }
    public function removeAll()
    {
        return null;
    }

    //LAB2
    public function validateForm()
    {
        //return true if values are not empty
        $fn = $this-> first_name;
        $ln = $this-> last_name;
        $city = $this-> city_name;
        if($fn == "" || $ln== "" || $city == ""){
            return false;
        }else
        {
            return true;
        }
    }

    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }

    public function hashPassword()
    {
     $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect()
    {
      $con = new DBConnector;
      $found = false;
      $res = mysqli_query($con->conn, "SELECT * FROM user_table") or die("Error : " .mysqli_error($con->conn));

      while($row = mysqli_fetch_array($res))
      {
        if(password_verify($this->getPassword(),$row['password']) && $this->getUsername() == $row['username'])
        {
          $found = true;
        }
      }
        $con->closeDatabase();
        return $found; //return true
    }

    public function login(){
        if($this->isPasswordCorrect())
        {
        //load protected page if password is correct
          header ("Location:private_page.php");
        }
    }

    public function createUserSession()
    {
     session_start();
     $_SESSION['username'] = $this->getUsername ();
    }

    public function logout()
    {
     session_start();
     unset($_SESSION['username']);
     session_destroy();
     header('Location:lab1.php');
    }

    public function isUserExist()
    {
        $con = new DBConnector;
        $found = false;
        $username = $this->username;
        $res = mysqli_query($con->conn, "SELECT * FROM user_table") or die("Error : " .mysqli_error($con->conn));
  
        while($row = mysqli_fetch_array($res))
        {
          if($row['username']==$username)
          {
            $found = true;
          }
        }
          $con->closeDatabase();
          return $found; //return true
    }
}

?>