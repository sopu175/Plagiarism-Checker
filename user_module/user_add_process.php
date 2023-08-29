<?php
include "../db/dbconfig.php";




if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $id = $_POST["id"];
    $email = $_POST["email"];
    $intake = $_POST['intake'];
    $section = $_POST['section'];
    $program = $_POST["program"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm = $_POST["cp_password"];


    if(empty($id)){
        echo "<script>alert('Please enter your ID ');</script>";
    }

    if(empty($email)){
        echo "<script>alert('Please enter your valid email');</script>";
    }
    if(empty($program)){
        echo "<script>alert('Please enter your program');</script>";
    }
    if(empty($phone)){
        echo "<script>alert('Please enter your mobile number');</script>";
    }
    if(empty($password)){
        echo "<script>alert('Please enter your password');</script>";
    }
    if(empty($confirm)){
        echo "<script>alert('Please confirm your password');</script>";

    }
    else{

       if($password == $confirm){
           $sql = "INSERT INTO user (name,email,id,intake,section,program,phone,password)
        VALUES ('$name','$email','$id','$intake','$section','$program','$phone','$password')";
           $result = mysqli_query($con,$sql);

           if($result){
               echo "<script>alert('Records added successfully.');
                setTimeout(\"location.href = '../index.php';\",500);</script>";

           } else{
               echo "ERROR: Could not able to execute  ";
           }
       }
        else {
            echo "<script>alert('Password Dont match. <br> Please Try again..');setTimeout(\"location.href = '../index.php';\",2000);</script>";

        }

    }





    mysqli_close($con);
}





?>