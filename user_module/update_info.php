<?php
include "../db/dbconfig.php";


session_start();

$user_Id = $_SESSION['id'];
$flag=0;

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $id = $_POST["id"];
    $email = $_POST["email"];
    $intake = $_POST['intake'];
    $section = $_POST['section'];
    $phone = $_POST["phone"];



    if(empty($id)){
        echo "<script>alert('Please enter your ID ');</script>";
    }

    if(empty($email)){
        echo "<script>alert('Please enter your valid email');</script>";
    }

    if(empty($phone)){
        echo "<script>alert('Please enter your mobile number');</script>";
    }


    else{


        $sql="UPDATE user SET name = '$name' , email = '$email' , id = '$id' , intake = '$intake', section = '$section', phone = '$phone' WHERE id='$user_Id'";
        $result = mysqli_query($con,$sql);

        if($result){
            echo "<script>alert('Records added successfully.');
                setTimeout(\"location.href = '../profile.php';\",500);</script>";

        } else{
            echo "ERROR: Could not able to execute  ";
        }

    }





    mysqli_close($con);
}





?>