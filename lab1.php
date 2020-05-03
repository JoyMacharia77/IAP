<?php
include_once 'DBConnector.php';
include_once 'user.php';

//$con = new DBConnector;

if(isset ($_POST['btn-save']))
{
    $first_name = $_POST ['first_name'];
    $last_name = $_POST ['last_name'];
    $city = $_POST ['city_name'];
    $username= $_POST ['username'];
    $password = $_POST ['password'];

    $user = new User($first_name,$last_name,$city,$username,$password);
    //LAB2
    if(!$user->validateForm())
    {
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
    }

    $res = $user-> save();

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
                    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                    
                </tr>
                <tr>
                    <td><a href="login.php">Login</a></td>
                </tr>
            </table>
        </form>
    </body>
</html>