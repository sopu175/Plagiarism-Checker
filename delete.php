<?php
session_start();
include "db/dbconfig.php";
$pid=$_POST['idfile'];
$query = "delete from file where id='$pid'";
//echo $query;
if (mysqli_query($con, $query)) {
    echo "<script> alert('Record Delete')</script>";
    header('Location: profile.php');
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
}

