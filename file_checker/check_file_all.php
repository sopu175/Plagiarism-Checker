<script src="../assets/js/solid.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.9.597/pdf.js"></script>
<script src="../assets/js/custom.js"></script>
<script>

    $(window).load(function () {
        // Animate loader off screen
        $('#loading').css('display', 'block').fadeIn(700).setTimeout(5000);
    });

</script>
<?php
session_start();
include "../db/dbconfig.php";
// Include 'Composer' autoloader.
include '../vendor/autoload.php';


$user_Id = $_SESSION['id'];

$docID = $_GET['docID'];
$sql2 = "SELECT * FROM file where id='$docID'";
$result_check_own = mysqli_query($con, $sql2);


$firs_file_id = null;
$FirstFileName = null;
$firstDestination = null;

while ($row = mysqli_fetch_assoc($result_check_own)) {
    $firs_file_id = $row['id'];
    $firstDestination = $row['destination'];
    $FirstFileName = $row['filename'];
}

$file_address = null;


$forAllSQL = "SELECT * FROM file where id!= '$docID'";


$resultForAll = mysqli_query($con, $forAllSQL);


$user_pass = $_SESSION['password'];


$sql_my_details = "SELECT * FROM user where id='$user_Id' && password='$user_pass'";
$result = mysqli_query($con, $sql_my_details);

$name = "";
$email = "";
$intake = "";
$section = "";
$program = "";
$phone = "";
while ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $email = $row['email'];
    $intake = $row['intake'];
    $section = $row['section'];
    $program = $row['program'];
    $phone = $row['phone'];
}
/* get all files */
$get_all_files = "SELECT * FROM file where user_id='$user_Id'";
$all_files_result = mysqli_query($con, $get_all_files);


/* check pdf , docx & txt */
$File_One_Extention = "";
$File_Two_Extention = "";
$For_File_One_Array = array();
$For_File_Tow_Array = array();
$percent = 0;
$pdf_get_string = null;
$pdf = 0;
$pdf_second_file_type = 0;
/* File One Function For get Content */
function fileOneContent($text)
{
    $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
    array_unshift($split, " ");

    $truncated = '';
    $j = 1;
    $k = 0;
    $a = array();
    for ($i = 0; $i < count($split); $i = $i + 2) {
        $truncated .= $split[$i] . $split[$i + 1];
        if ($j % 2 == 0) {
            $a[$k] = $truncated;
            $truncated = '';
            $k++;
            $j = 0;
        }
        $j++;
    }
    file_put_contents("FileOneContent.txt", var_export($a, true));
    return ($a);
}

/* File One Function For get Content */


/* File two Function For get Content */
function fileTwoContent($text)
{
    $split = preg_split('/(\s+)/', $text, 0, PREG_SPLIT_DELIM_CAPTURE);
    array_unshift($split, " ");

    $truncated = '';
    $j = 1;
    $k = 0;
    $a = array();
    for ($i = 0; $i < count($split); $i = $i + 2) {
        $truncated .= $split[$i] . $split[$i + 1];
        if ($j % 2 == 0) {
            $a[$k] = $truncated;
            $truncated = '';
            $k++;
            $j = 0;
        }
        $j++;
    }
    file_put_contents("FileTwoContent.txt", var_export($a, true));
    return ($a);
}

/* File One Function For get Content */


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

    $content = str_replace('#[\\s-]+#\',\',"\'", /[^\w]/,\'#[^A-Za-z0-9. -]+#', "", $content);
    $content = str_replace('#[\\s-]+#\',\',"\'",/[^\w]/ ,\'#[^A-Za-z0-9. -]+#', "", $content);

    $str = preg_replace("/'/", " ", $content);

    $striped_content = strip_tags($str);

    return $striped_content;
}

/* read docx file content */


//pdf file
function pdf_read($file)
{
    $parser = new \Smalot\PdfParser\Parser();
    $File_one = null;

    $pdf = $parser->parseFile($file);
    $pages = $pdf->getPages();
    $File = null;
    foreach ($pages as $page) {
        $File_one = implode("/", preg_split("/[\s]	+/", $page->getText()));


        return $File_one;
    }

}

$First_FileDestination = "../" . $firstDestination;
$File_One_Extention = pathinfo($First_FileDestination, PATHINFO_EXTENSION);




?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compare File</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">


</head>
<body>

<div id="loading">
    <img id="loading-image" src="../assets/image/ajaxloader.gif" alt="Loading..."/>
</div>


<?php
include '../template/header.php';

?>


<!-----------------------------------------------Box Section Start --------------------------------------------------->
<section class="main_body_profile">

    <div class="container main-wrapper">
        <div class="Flex">

            <!------------------------------------------ menu box ----------------------------------------------------->
            <div class="col-md-4 right_sidebar">
                <div class="name_title">
                    <p class="bubt-title">Welcome <?php if ($name == null) {
                            echo $user_Id;
                        } else {
                            echo $name;
                        } ?></p>
                </div>
                <div class="menubox ">
                    <ul class="  menu">
                        <li class="">
                            <a  href="../profile.php" class="menuitem">

                                <p><span><i class="fa fa-user" aria-hidden="true"></i></span>Profile</p>

                            </a>
                        </li>
                        <li>
                            <a  href="../profile.php" class="menuitem">

                                <p><span><i class="fa fa-upload" aria-hidden="true"></i></span> Upload File</p>


                            </a>
                        </li>
                        <li>
                            <a  href="../profile.php" class="menuitem">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span> View Files</p>


                            </a>
                        </li>
                        <li>
                            <a href="../index.php" class="menuitem">

                                <p><span>  <i class="fa fa-sign-out"></i></span>Logout</p>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!---------------------------------------------menu box end ----------------------------------------------->


            <!---------------------------------------- ---------tab content start ------------------------------------->

            <div class="col-md-8 profile_content_body  mCustomScrollbar" data-mcs-theme="dark">
                <div class="tab-content">

                    <!--- select first file -->
                    <div id="file_check" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-12 file_wrapper_all">

                                    <table class="table_for_allfile">
                                        <tr class="title">
                                            <td>File Name</td>
                                            <td>Result</td>
                                        </tr>
                                <?php
                                if ($File_One_Extention == 'txt') {


                                    while ($row = mysqli_fetch_assoc($resultForAll)) {


                                        $Second_FileDestination = "../" . $row['destination'];
                                        $extension = pathinfo($Second_FileDestination, PATHINFO_EXTENSION);

                                        if ($extension == 'txt') {
                                            $File_one = preg_replace('/[.,]/', '', file_get_contents($First_FileDestination, FALSE));


                                            $File_two = preg_replace('/[.,]/', '', file_get_contents($Second_FileDestination, FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            /* check the two files content */
                                            $count = 0;
                                            $couter = 0;
                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j = $j + 1) {

                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {


                                                        $count = $count + 1;


                                                    } else {
                                                        $count = $count + 0;

                                                    }




                                                }


                                            }


?>




          <tr>
              <td>

                  <p class="file_result"><?php echo $row['filename']?></p>
              </td>
              <td>
                  <?php

                  if ($count > $second_file_length) {
                      $minus = $count - $second_file_length;
                      $count = $count - ($minus + 1);
                      echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                  } else
                      echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                  ?>
              </td>
          </tr>


                                <?php



//


                                        }

                                        if ($extension == 'docx') {


                                            $doc_file_content = file_put_contents("DocFileCOntent.txt", var_export(read_docx($Second_FileDestination), true));;


                                            $File_one = preg_replace('/[.,]/', '', file_get_contents($First_FileDestination, FALSE));
                                            $File_two = preg_replace('\'/[^\w-^A-Za-z0-9\-]/\'', '', file_get_contents('DocFileCOntent.txt', FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            /* check the two files content */
                                            $count = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
                                                        $count = $count + 1;

                                                    } else
                                                        $count = $count + 0;
                                                }
                                            }
                                            /* check the two files content */

                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>


                                            <?php



                                        }

                                        if ($extension == 'pdf') {
                                            $File_one = preg_replace('/[.,]/', '', file_get_contents($First_FileDestination, FALSE));

                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", pdf_read($Second_FileDestination)));
                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            /* check the two files content */

                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            $count = 0;
                                            $couter = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
//                        echo $File_One_Array[$k]. '='. $File_Two_Array[$j] . "<br>";
                                                        $count = $count + 1;
//
//                        echo $count."<br>";
                                                    } else {
                                                        $count = $count + 0;
                                                    }


                                                }


                                            }

                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>







                                            <?php



                                        }
                                    }
                                }


                                if ($File_One_Extention == 'docx') {


                                    while ($row = mysqli_fetch_assoc($resultForAll)) {


                                        $Second_FileDestination = "../" . $row['destination'];
                                        $extension = pathinfo($Second_FileDestination, PATHINFO_EXTENSION);


                                        if ($extension == 'txt') {
                                            $doc_file_content = file_put_contents("DocFileCOntent_two.txt", var_export(read_docx($First_FileDestination), true));;


                                            $File_one = preg_replace('/[.,]/', '', file_get_contents("DocFileCOntent_two.txt", FALSE));


                                            $File_two = preg_replace('/[.,]/', '', file_get_contents($Second_FileDestination, FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            /* check the two files content */
                                            $count = 0;
                                            $count = 0;
                                            $couter = 0;


                                            for ($k = 0; $k < count($File_Two_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_One_Array); $j++) {
                                                    if ($File_Two_Array[$k] == $File_One_Array[$j]) {


                                                        $couter = $couter + 1;

                                                    } else {
                                                        $couter = $couter + 0;
                                                    }


                                                }


                                            }

                                            /* check the two files content */

//            echo "file one = " .count($File_One_Array) ."<br>";
//            echo "file tow = " .count($File_Two_Array) ."<br>";
//            echo  $count . "<br>";

                                ?>




                  <tr>
                      <td>

                          <p class="file_result"><?php echo $row['filename']?></p>
                      </td>
                      <td>
                          <?php

                          if ($count > $second_file_length) {
                              $minus = $count - $second_file_length;
                              $count = $count - ($minus + 1);
                              echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                          } else
                              echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                          ?>
                      </td>
                  </tr>


                  <?php

//


                                        }


                                        if ($extension == 'docx') {
                                            $doc_file_content_one = file_put_contents("DocFileCOntent.txt", var_export(read_docx($First_FileDestination), true));;

                                            $doc_file_content_two = file_put_contents("DocFileCOntent_two.txt", var_export(read_docx($Second_FileDestination), true));;


                                            $File_one = preg_replace('/[.,]/', '', file_get_contents('DocFileCOntent.txt', FALSE));

                                            $File_two = preg_replace('/[.,]/', '', file_get_contents('DocFileCOntent_two.txt', FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_String2 = implode("/", preg_split("/[\s]	+/", $File_One_String));
                                            $File_Two_String2 = implode("/", preg_split("/[\s]	+/", $File_Two_String));


                                            $File_One_Array = (fileOneContent($File_One_String2));
                                            $File_Two_Array = (fileTwoContent($File_Two_String2));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            /* check the two files content */
                                            $count = 0;
                                            $count = 0;
                                            $couter = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {

                                                        $count = $count + 1;


                                                    } else {
                                                        $count = $count + 0;
                                                    }


                                                }


                                            }

                                            for ($k = 0; $k < count($File_Two_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_One_Array); $j++) {
                                                    if ($File_Two_Array[$k] == $File_One_Array[$j]) {


                                                        $couter = $couter + 1;

                                                    } else {
                                                        $couter = $couter + 0;
                                                    }


                                                }


                                            }




                                 ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>
                  <?php

                                        }


                                        if ($extension == 'pdf') {
                                            $doc_file_content = file_put_contents("DocFileCOntent_two.txt", var_export(read_docx($First_FileDestination), true));;

                                            $File_one = preg_replace('/[.,]/', '', file_get_contents("DocFileCOntent_two.txt", FALSE));

                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", pdf_read($Second_FileDestination)));
                                            $File_One_String = implode("/", preg_split("/[\s]	+/", $File_one));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            /* check the two files content */

                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            $count = 0;
                                            $couter = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
//                        echo $File_One_Array[$k]. '='. $File_Two_Array[$j] . "<br>";
                                                        $count = $count + 1;
//
//                        echo $count."<br>";
                                                    } else {
                                                        $count = $count + 0;
                                                    }


                                                }


                                            }


                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>
                                            <?php


                                        }


                                    }
                                }


                                if ($File_One_Extention == 'pdf') {


                                    while ($row = mysqli_fetch_assoc($resultForAll)) {


                                        $Second_FileDestination = "../" . $row['destination'];
                                        $extension = pathinfo($Second_FileDestination, PATHINFO_EXTENSION);




                                        if ($extension == 'txt') {

                                            $File_two = preg_replace('/[.,]/', '', file_get_contents($Second_FileDestination, FALSE));

                                            $File_One_String = implode("/", preg_split("/[\s]	+/", pdf_read($First_FileDestination)));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);


                                            /* check the two files content */
                                            $count = 0;
                                            $couter = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
//                        echo $File_One_Array[$k]. '='. $File_Two_Array[$j] . "<br>";
                                                        $count = $count + 1;
//
//                        echo $count."<br>";
                                                    } else {
                                                        $count = $count + 0;
                                                    }


                                                }


                                            }


                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>







                                            <?php

                                        }

                                        if ($extension == 'docx') {


                                            $doc_file_content = file_put_contents("DocFileCOntent.txt", var_export(read_docx($Second_FileDestination), true));;

                                            $File_two = preg_replace('/[.,]/', '', file_get_contents('DocFileCOntent.txt', FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", pdf_read($First_FileDestination)));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", $File_two));


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            /* check the two files content */
                                            $count = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
                                                        $count = $count + 1;

                                                    } else
                                                        $count = $count + 0;
                                                }
                                            }
                                            /* check the two files content */

                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>







                                            <?php
                                        }


                                        if ($extension == 'pdf') {


                                            $doc_file_content = file_put_contents("DocFileCOntent.txt", var_export(read_docx($Second_FileDestination), true));;

                                            $File_two = preg_replace('/[.,]/', '', file_get_contents('DocFileCOntent.txt', FALSE));


                                            $File_One_String = implode("/", preg_split("/[\s]	+/", pdf_read($First_FileDestination)));
                                            $File_Two_String = implode("/", preg_split("/[\s]	+/", pdf_read($Second_FileDestination)));;


                                            $File_One_Array = (fileOneContent($File_One_String));
                                            $File_Two_Array = (fileTwoContent($File_Two_String));


                                            $second_file_length = count($File_Two_Array);
                                            $first_file_length = count($File_One_Array);

                                            /* check the two files content */
                                            $count = 0;
                                            for ($k = 0; $k < count($File_One_Array); $k = $k + 1) {
                                                for ($j = 0; $j < count($File_Two_Array); $j++) {
                                                    if ($File_One_Array[$k] == $File_Two_Array[$j]) {
                                                        $count = $count + 1;

                                                    } else
                                                        $count = $count + 0;
                                                }
                                            }
                                            /* check the two files content */
//
//            echo "file one = " .count($File_One_Array) ."<br>";
//            echo "file tow = " .count($File_Two_Array) ."<br>";
//            echo  $count . "<br>";

                                            ?>

                                            <tr>
                                                <td>

                                                    <p class="file_result"><?php echo $row['filename']?></p>
                                                </td>
                                                <td>
                                                    <?php

                                                    if ($count > $second_file_length) {
                                                        $minus = $count - $second_file_length;
                                                        $count = $count - ($minus + 1);
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';
                                                    } else
                                                        echo $percent = (round(($count) / $second_file_length * 100, 2)).'%';


                                                    ?>
                                                </td>
                                            </tr>







                                            <?php

                                        }

                                    }


                                }


                                ?>
      </table>
  </div>
                            </div>
                        </div>
                    </div>
                    <!--- select first file -->


                </div>
            </div>

            <!---------------------------------------- ---------tab content end ------------------------------------->


        </div>
    </div>
</section>
<!-----------------------------------------------Box Section end --------------------------------------------------->


<footer>
    <div class="container">
        <div class="row">
            <p style="text-align: center">© 2020 </p>
        </div>
    </div>
</footer>


<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/lightgallery.js"></script>
<script src="../assets/js/jquery.nice-select.min.js"></script>
<script src="../assets/js/slick.js"></script>
<script src="../assets/js/dropzone.js"></script>
<script src="../assets/js/jquery.mCustomScrollbar.js"></script>
<script src="../assets/js/custom.js"></script>
<script src="../assets/js/solid.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.9.597/pdf.js"></script>


</body>
</html>

