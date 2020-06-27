<?php
include_once 'DBconnector.php';

session_start();
if(!isset($_SESSION['username']))
{
    header("Location:login.php");
}

//LAB 4:API KEY
function fetchUserApiKey(){
    $id = $_SESSION['id'];
    $con = new DBConnector();
  
    $sql = "SELECT api_key FROM api_keys WHERE user_id='$id'";
    $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
    
    if ($res->num_rows <= 0) {
        return 'API Key Generation Required';
    }else{
      while($row = $res->fetch_array()){
        $api_key = $row['api_key'];
      }
      return $api_key;
    }
   
 }
?>

<html>
    <head>
        <title>ACCESSIBLE TO LOGGED IN USER</title>
        <script type="text/javascript" src="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">

        <!--BOOTSRAP-->
          <!--JS-->
       <script type="text/javascript" src="apikey.js"></script>

        <!--CSS-->
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </head>
    <body>
        <p>This is a private page</p>
        <p>We want to protect it</p>
        <p><a href= "logout.php">Logout</a></p>

        <!--LAB 4-->
        <hr>
        <h3>Here, we will create an API that will allow Users/Developer to order items from external systems</h3>
        <hr>
        <h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

        <button class="btn btn-primary" id="api-key-btn">Generate APi key</button> <br> <br>

        <!---ThIS text area  will hold the API key-->
        <strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating new key will stop the application from functioning) <br>

        <textarea name="api_key" id="api_key" cols="100" rows="2" readonly> <?php echo fetchUserApiKey(); ?> </textarea>

        <h3>Service Description:</h3>
        We have a service/API that allows extrenal applications to order food and also pull all order status by using order id. Let's do it

        <hr>
    </body>
</html>