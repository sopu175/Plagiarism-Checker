<?php
include "../db/dbconfig.php";






if (isset($_POST['submit'])) {
    $password = $_POST["password"];
    $confirm = $_POST["cp_password"];


    if (empty($password)) {
        echo "<script>alert('Please enter your ID ');</script>";
    }

    if (empty($confirm)) {
        echo "<script>alert('Please enter your valid email');</script>";
    } else {


        $sql = "UPDATE user SET password = '$password'  WHERE id='$user_Id'";
        $result = mysqli_query($con, $sql);

        if ($password == $confirm) {
            if ($result) {
                echo "<script>alert('Password Changed successfully.');
                setTimeout(\"location.href = '../profile.php';\",500);</script>";

            }
        } else {
            echo "ERROR: Could not able to execute  ";
        }

    }


    mysqli_close($con);
}


?>