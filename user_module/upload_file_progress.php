<?php
session_start();
include "../db/dbconfig.php";
$user_Id = $_SESSION['id'];
$flag=0;

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myFile']['name'];

    $categroy_id = $_POST['category'];


    // destination of the file on the server
    $destination = '../uploads/' . $filename;
    $thumbDirectory = '../assets/image/thumb';
    $mainDestination = "uploads/". $filename;
    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myFile']['tmp_name'];
    $file_user = $_FILES['myFile']['tmp_name'];
    $size = $_FILES['myFile']['size'];

    //name the thumbnail image the same as the pdf file




    if (!in_array($extension, ['pdf', 'docx','txt'])) {
        echo "You file extension must be .pdf ,txt or .docx";
    } elseif ($_FILES['myFile']['size'] > 10000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $thumb = $filename.".jpg";
            //execute imageMagick's 'convert', setting the color space to RGB and size to 200px wide
            exec("convert \"{$destination}[0]\" -colorspace RGB -geometry 200 $thumbDirectory$thumb");
            $sql = "INSERT INTO pending (user_id,filename,filesize,destination,file,category_id) VALUES ('$user_Id','$filename','$size','$mainDestination','$file','$categroy_id')";


            if (mysqli_query($con, $sql)) {
                echo "File uploaded successfully";
                header('Location:../profile.php');
            }

         $flag= 1;
        }
       /* if($flag==1){
            if(!copy($destination,$destination_user)){
                echo "failed to copy $file";
            }
        }*/
        else {
            echo "Failed to upload file.";
        }
    }
}
?>