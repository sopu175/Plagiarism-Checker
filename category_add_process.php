<?php
include "db/dbconfig.php";

$id = $_POST['category_name'];
if(isset($_POST['submit'])){


    if(empty($id)){
        echo "<script>alert('Enter Category Name ');</script>";
    }
    else{
        $sql = "INSERT INTO category (name)
        VALUES ('$id')";

        if($result ) {

            header('Location:dashboard.php');
        }
        else
            die('Could not delete data: ' . mysqli_query());
    }



}


?>