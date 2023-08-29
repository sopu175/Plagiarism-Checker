<?php
session_start();
include "db/dbconfig.php";
// Include 'Composer' autoloader.
include 'vendor/autoload.php';


$user_Id = $_SESSION['id'];
$user_pass = $_SESSION['password'];


$sql = "SELECT * FROM user where id='$user_Id' && password='$user_pass'";
$category = "SELECT * from category";
$modal = null;
$result = mysqli_query($con, $sql);
$category_result = mysqli_query($con, $category);


$name = "";
$email = "";
$intake = "";
$section = "";
$program = "";

$user_Id = "";
$phone = "";
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $user_Id = $row['id'];
    $email = $row['email'];
    $intake = $row['intake'];
    $section = $row['section'];
    $program = $row['program'];
    $phone = $row['phone'];

    $image =  $row['image_src'];
}


$get_all_files = "SELECT * FROM file ";
$all_files_result = mysqli_query($con, $get_all_files);


$category_result_extra = mysqli_query($con, $category);
$category_name = "";

$category_id = "";


/* read doc file content */
function read_doc($name)
{
    $fileHandle = fopen($name, "r");
    $line = @fread($fileHandle, filesize($name));
    $lines = explode(chr(0x0D), $line);
    $outtext = "";
    foreach ($lines as $thisline) {
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE) || (strlen($thisline) == 0)) {
        } else {
            $outtext .= $thisline . " ";
        }
    }
    $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);
    return $outtext;
}

/* read doc file content end */


/* read docx file content */
function read_docx($name)
{

    $striped_content = '';
    $content = '';

    $zip = zip_open($name);

    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
}

/* read docx file content */

//
//while ($row = mysqli_fetch_assoc($resultForAll)) {
//    //echo $row['filename'];
//    $des = $row['destination'];
//    echo "<option value='" . $des . "'>" . $row['filename'] . "</option>";
//}

?>