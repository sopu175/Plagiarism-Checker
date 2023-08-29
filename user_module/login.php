<?php
session_start();
include "../db/dbconfig.php";

if(isset($_POST['submit']))
{


    $username = $_POST['id'];
    $pass = $_POST['password'];
    if((empty($username)) && (!empty($pass))){
        echo "<script>alert('Please enter your ID ');setTimeout(\"location.href = '../index.php';\");</script>";
    } else if((empty($pass)) && (!empty($username))) {
        echo "<script>alert('Please enter your password');setTimeout(\"location.href = '../index.php';\");</script>";
    }
    else if(empty($username) && empty($pass)){
        echo "<script>alert('Please enter your username & password');setTimeout(\"location.href = '../index.php';\");</script>";
    }
    else{

        $for_user = "SELECT * FROM user where id='".$username."' and password='".$pass."'" ;
        $for_userResult = str_replace("\'","",$for_user);
        $user_Result = mysqli_query($con,$for_userResult);
        $User_row = mysqli_num_rows($user_Result);

        if($User_row == 1)
        {
            session_start();
            $_SESSION['id']=$username;
            $_SESSION['password']=$pass;
            header('Location:../profile.php');

        }
        else {
            echo "<script>alert('Sorry wrong username & password. <br> Please Try again..');setTimeout(\"location.href = '../index.php';\",2000);</script>";

        }

    }





    mysqli_close($con);
}



?>
