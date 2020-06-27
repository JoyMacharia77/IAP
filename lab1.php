<?php
include_once 'DBConnector.php';
include_once 'user.php';

//$con = new DBConnector;

if(isset ($_POST['btn-save']))
{   //LAB1
    $first_name = $_POST ['first_name'];
    $last_name = $_POST ['last_name'];
    $city = $_POST ['city_name'];
     //LAB2
    $username= $_POST ['username'];
    $password = $_POST ['password'];
     //LAB3
    $utc_timestamp =$_POST['utc_timestamp'];
    $offset = $_POST['time_zone_offset'];

    $user = new User($first_name,$last_name,$city,$username,$password);
    //LAB2
    //Create object for file uploading
    $uploader = new FileUploader();
    if(!$user->validateForm())
    {
        $user->createFormErrorSessions();
        header("Location:lab1.php");
        die();
    }

    $res = $user-> save();
    //Call uploadFile() function,which returns
    $file_upload_response = $uploader ->uploadFile();

    if($user->isUserExist($username))
    {
        echo "THe Username is currently in use.Please try again";
    }
    else 
    {
        if($res)
    {
        echo "Save Operation was Successful";
    }else
    {
        echo "An Error Occurred!";
    }
}
}
?>


<html>
    <head>
        <title>LAB 1 USER FORM</title>
        <!--LAB2-->
        <script type ="text/javascript" src="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
        <!--LAB3-->
        <!-- include jquery here: This is from a cnd network,google-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--The new js file comes after including the jquery-->
        <script type="text/javascript" src="timezone.js"></script>
    </head>
    <body>
        <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
            <table align="center">
                <!--LAB2-->
            <tr>
            <td>
            <div id="form-errors">
                <?php 
                    session_start();
                    if(!empty($_SESSION['form_errors'])){
                        echo " " . $_SESSION['form_errors'];
                        unset($_SESSION['form_errors']);
                    }
                ?>
            </div>
            </td>
            </tr>
                <tr>
                    <td><input type="text" name="first_name" required placeholder="First Name" /> </td>
                </tr>
                <tr>
                    <td><input type="text" name="last_name" required placeholder="Last Name" /> </td>
                </tr>
                <tr>
                    <td><input type="text" name="city_name" required placeholder="City" /> </td>
                </tr>
                <tr>
                    <td><input type ="text" name="username" placeholder="Username"/></td>
                </tr>
                <tr>
                    <td><input type ="password" name="password" placeholder="Password"/></td>
                </tr>
                <tr>
                    <td>Profile image:<input type ="file" name="fileToUpload" id="fileToUpload"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                    
                </tr>
                <!--Create hidden controls to store client utc date and time zone-->
                <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
                <input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>
                <tr>
                    <td><a href="login.php">Login</a></td>
                </tr>
            </table>
        </form>
    </body>
</html>