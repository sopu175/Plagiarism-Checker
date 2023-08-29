<?php
session_start();
include "../db/dbconfig.php";
$user_Id = $_SESSION['id'];


$docID = $_POST['docID'];
$sql = "SELECT * FROM pending where id='$docID'";
$result = mysqli_query($con, $sql);



$user_Id = "";
$file_name = "";
$file_size = "";
$destination = "";
$file = "";
$category = "";
while ($row = mysqli_fetch_assoc($result)) {
    $user_Id = $row['user_id'];
    $file_name = $row['filename'];
    $file_size = $row['filesize'];
    $destination = $row['destination'];
    $file = $row['$file'];
    $category = $row['category_id'];

}

echo $user_Id;
echo $file_name;
$sqll = "delete  FROM pending where id='$docID'";

$sql = "INSERT INTO file (user_id,filename,filesize,destination,file,category_id) VALUES ('$user_Id','$file_name','$file_size','$destination','$file','$category')";


if ((mysqli_query($con, $sql) && mysqli_query($con,$sqll))) {

    header('Location: ../dashboard.php');

}
else
    echo "wrong";

?>