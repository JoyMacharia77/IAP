<?php
    include_once 'DBconnector.php';

    session_start();
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
   
    
     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
       //To deny a user access to the page via the url
       header('HTTP/1.0 403 Forbidden');
       echo 'You are forbidden';
     }else{
       $api_key = null;
       //Generate a key 64 characters long
       $api_key = generateApiKey(64);
       header('Content-type: application/json');
       //Response if its in json
       echo generateResponse($api_key);
     }
     
      //This is how we generate a key
      function generateApiKey($str_length){
       // Base 62 map
       $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

       //get enough  randombits for base 64 encoding (and prevent '=' padding)
       // NOTE: +1 is better than ceil()
       $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

       //convert base 64 to base 62 mapping + and / to something from the base 62 map
       //Use the first 2 random bytes for the new characters
       $repl = unpack('C2',$bytes);
 
       $first = $chars[$repl[1]%62];
       $second = $chars[$repl[2]%62];
       return strtr(substr(base64_encode($bytes), 0 ,$str_length), '+/' , "$first$second");
     }
 
     //saves the API for currently logged in User
     function saveApiKey($api_key){

       session_start();
       $con = new DBConnector();
       $id = $_SESSION['id'];
       $sql = "INSERT INTO api_keys(user_id,api_key) VALUES('$id','$api_key')";
       $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
        
        return $res;
     }
 
 
     function generateResponse($api_key){
       if(saveApiKey($api_key) === TRUE){
         $res = ['success'=> 1, 'message'=> $api_key];
       }else{
         $res = ['success' => 0, 'message'=> "Something went wrong. Please regenerate the API"];
       }
       return json_encode($res);
     }

     
?>