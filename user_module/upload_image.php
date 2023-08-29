<?php

session_start();
include "../db/dbconfig.php";
$user_Id = $_SESSION['id'];
$flag=0;


if (isset($_POST['upload'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myFile']['name'];

    // destination of the file on the server
    $destination = '../uploads/user/' . $filename;

    $main = './uploads/user/' . $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myFile']['tmp_name'];
    $file_user = $_FILES['myFile']['tmp_name'];
    $size = $_FILES['myFile']['size'];

    //name the thumbnail image the same as the pdf file


$sql = "UPDATE user SET image_src = '$main' WHERE id = '$user_Id'";
    echo $destination;
    if (!in_array($extension, ['jpg','png','jpeg','gif'])) {
        echo "You file extension must be 'jpg','png','jpeg','gif'";
    } elseif ($_FILES['myFile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            if (mysqli_query($con, $sql)) {
                echo "File uploaded successfully";
                header('Location:../profile.php');
            }
        }
        else {
            echo "Failed to upload file.";
        }
    }
}

?>