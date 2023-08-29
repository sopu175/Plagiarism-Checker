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
}


$get_all_files = "SELECT * FROM file ";
$get_pending_files = "SELECT * FROM pending ";
$pending_user = 'SELECT * FROM user LEFT JOIN pending ON pending.user_id=user.id WHERE pending.user_id = user.id';



$pending_user_resutl = mysqli_query($con,$pending_user);
$all_files_result = mysqli_query($con, $get_all_files);
$all_files_pending_result = mysqli_query($con, $get_pending_files);

$category_result_extra = mysqli_query($con, $category);

$category_result_for_show = mysqli_query($con, $category);
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



if(isset($_POST['save'])){

    $id = $_POST['category_name'];
    if(empty($id)){
        echo "<script>alert('Enter Category Name ');</script>";
    }
    else{
        $sqll = "INSERT INTO category (name)
        VALUES ('".$_POST["category_name"]."')";
        $result = mysqli_query($con,$sqll);
        if($result ) {

            header('Location:dashboard.php');
        }
        else
            die('Could not delete data: ' . mysqli_query());
    }



}


?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <?php include 'template/header_layout.php' ?>

    <style>
        .FilterFile {

        }
    </style>
</head>
<body class="admin">


<nav class="navbar navbar-dark bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="#">Dashboard</a></li>
    </ul>
</nav>


<!-----------------------------------------------Box Section Start --------------------------------------------------->
<section class="main_body_profile">

    <div class="container main-wrapper">
        <div class="">

            <!------------------------------------------ menu box ----------------------------------------------------->
            <div class="col-md-3 right_sidebar">

                <div class="menubox">
                    <ul class="  menu">
                        <li class="active">
                            <a data-toggle="pill" href="#profiel_details" class="menuitem">

                                <p><span><i class="fa fa-user" aria-hidden="true"></i></span>Pending File</p>

                            </a>
                        </li>

                        <li>
                            <a data-toggle="pill" href="#view_files" class="menuitem" id="viewfile">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span>Files</p>


                            </a>
                        </li>

                        <li>
                            <a data-toggle="pill" href="#category" class="menuitem" id="categoryy">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span>Add Category</p>


                            </a>
                        </li>
                        <li>
                            <a id="logout" href="index.php" class="menuitem">

                                <p><span>  <i class="fa fa-sign-out"></i></span>Logout</p>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!---------------------------------------------menu box end ----------------------------------------------->


            <!---------------------------------------- ---------tab content start ------------------------------------->

            <div class="col-md-9 profile_content_body ">
                <div class="tab-content">


                    <!----------------------------------------- profile details --------------------------------------->
                    <div id="profiel_details" class="tab-pane fade in active">
                        <div class="row">
                            <div class="profile_info_table pending_table">
                                <h3>Peding Files</h3>
                                <div class="profile_info_table_wrapp ">

                                    <table class="">
                                        <tr>
                                            <td>Name</td>
                                            <td>File name</td>
                                            <td colspan="3"></td>



                                        </tr>
                                      <?php
                                      while($pending_file_row = mysqli_fetch_assoc($pending_user_resutl)){

                                          if($pending_file_row == null){
                                              echo "There are no pending files left";
                                          }


                                          ?>



                                          <tr>
                                              <td>
                                                  <p><?php echo $pending_file_row['name'] ?> <br>
                                                  <span>Intake: <?php echo $pending_file_row['intake'];?></span> <br>
                                                      <span>Id: <?php echo $pending_file_row['user_id'];?></span> <br>
                                                      <span>Program: <?php echo $pending_file_row['program'];?></span>
                                                  </p>


                                              </td>
                                              <td><?php echo $pending_file_row['filename'] ?></td>
                                              <td>
                                                  <form action="admin/aprrove.php" method="post">
                                                      <input type="text" hidden="true" name="docID" value="<?php echo $pending_file_row['id'] ?>">

                                                      <input type="submit" value="Aprrove">
                                                  </form>

                                              <td>


                                                  <form action="admin/delete.php" method="post">
                                                      <input type="text" hidden="true" name="idfile" value="<?php echo $pending_file_row['id'] ?>">

                                                      <input type="submit" value="Delete">
                                                  </form>

                                              </td>
                                              <td><a class="check" href="admin_select_file.php?docID=<?php echo $pending_file_row['id'] ?>">Check</a></td>

                                          </tr>

                                        <?php


                                      }

                                      ?>
                                    </table>
                                </div>


                            </div>

                        </div>
                    </div>
                    <!--------------------------- profile details end ------------------------------------------------->



                    <!----------------------------------------- view file star----------------------------------------->
                    <div id="view_files" class="tab-pane fade view_file_tab_content">
                        <div class="FileViewThumbnail ">
                            <ul class="FilterNav">
                                <li><a id="all" class="active" data-filter="*" href="javascript:">All</a></li>

                            </ul>


                            <div class="col-md-12" style="padding: 0px">

                                <?php

                                while (($row_category = mysqli_fetch_assoc($category_result_extra))) {
                                    ?>

                                    <h3 class="categoryname">
                                        <?php
                                        echo $row_category['name'];

                                        ?>
                                    </h3>

                                    <div class="FilterFile" style="min-height: 100% !important;">


                                        <?php

                                        $get_all_files = "SELECT * FROM file  where  category_id = $row_category[id]";
                                        $all_files_result = mysqli_query($con, $get_all_files);
                                        while ($row = mysqli_fetch_assoc($all_files_result)) {

                                            $flag = false;
                                            $extension = pathinfo($row['filename'], PATHINFO_EXTENSION);
                                            ?>
                                            <div class="col-md-3 asViewFile <?php
                                            if ($user_Id == $row['user_id']) {
                                                echo "myfiles";
                                                $flag = true;
                                            } else {
                                                echo "";
                                                $flag = false;
                                            }

                                            ?> " <?php echo "id=" . $row['id'] ?>>
                                                <div class="file_box_wrapper" style="overflow: hidden; ">
                                                    <div class="filebox">

                                                        <a  href="admin_select_file_individual.php?docID=<?php echo $row['id'] ?>">

                                                            <div class="file_image"
                                                                <?php
                                                                if ($extension == "docx") {
                                                                    echo 'style="background-image: url(\'assets/image/thumb/doc.jpg\')"';
                                                                    $pdf = "docx";
                                                                }
                                                                if ($extension == "pdf") {
                                                                    echo 'style="background-image: url(\'assets/image/thumb/download.png\')"';
                                                                    $pdf = "embedURL";
                                                                }
                                                                if ($extension == "txt") {
                                                                    echo 'style="background-image:url(\'assets/image/thumb/images.jfif\')"';
                                                                    $pdf = "text";
                                                                }
                                                                ?>

                                                            >
                                                                <div class="overflow">
                                                                    <p>Individual Check</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="file_name">
                                                            <a id="<?php echo $pdf; ?>"
                                                               href="#<?php echo $row['id'] ?>"

                                                               data-toggle="modal"
                                                               data-target="#exampleModal<?php echo $row['id'] ?>"
                                                            >
                                                                <p><?php echo $row['filename']; ?></p></a>
                                                            <div class="clearfix"></div>

                                                            <a class="check_with_all_files" href="file_checker/check_all_admin.php?docID=<?php echo $row['id'] ?>">Check With All Files</a>

                                                        </div>

                                                        <div class="modal fade"
                                                             id="exampleModal<?php echo $row['id'] ;

                                                             $modal= $row['id'];
                                                             ?>" tabindex="-1"
                                                             role="dialog"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content"
                                                                >
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel"
                                                                            style="text-transform: uppercase">
                                                                            <?php echo $row['filename'];


                                                                            ?>

                                                                        </h5>


                                                                        <?php
                                                                        if($flag == true)
                                                                        {
                                                                            ?>

                                                                            <form action="delete.php" method="post">

                                                                                <input type="text" hidden="true" name="idfile" value="<?php echo $row['id'] ?>">
                                                                                <input type="submit" value="Delete">
                                                                            </form>

                                                                            <?php

                                                                        }


                                                                        ?>

                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body ">
                                                                        <div class="overflow_text ">
                                                                            <?php
                                                                            $First_FileDestination = "" . $row['destination'];
                                                                            $File_One_Extention = pathinfo($First_FileDestination, PATHINFO_EXTENSION);

                                                                            if ($File_One_Extention == 'txt') {
                                                                                $File_one = preg_replace('/[.,]/', '', file_get_contents($First_FileDestination, FALSE));

                                                                                ?>
                                                                                <p class="content">
                                                                                    <?php echo $File_one; ?>
                                                                                </p>

                                                                                <?php
                                                                            }


                                                                            if ($File_One_Extention == 'docx') {
                                                                                $doc_file_content_one = file_put_contents("DocFileCOntent.txt", var_export(read_docx($First_FileDestination), true));;
                                                                                $File_one = preg_replace('/[.,]/', '', file_get_contents('DocFileCOntent.txt', FALSE));

                                                                                ?>
                                                                                <p class="content">
                                                                                    <?php echo $File_one; ?>
                                                                                </p>

                                                                                <?php
                                                                            }


                                                                            if ($File_One_Extention == 'pdf') {
                                                                                $parser = new \Smalot\PdfParser\Parser();
                                                                                $File_one = null;
                                                                                $problem_enc=array(
                                                                                    'euro',
                                                                                    'sbquo',
                                                                                    'bdquo',
                                                                                    'hellip',
                                                                                    'dagger',
                                                                                    'Dagger',
                                                                                    'permil',
                                                                                    'lsaquo',
                                                                                    'lsquo',
                                                                                    'rsquo',
                                                                                    'ldquo',
                                                                                    'rdquo',
                                                                                    'bull',
                                                                                    'ndash',
                                                                                    'mdash',
                                                                                    'trade',
                                                                                    'rsquo',
                                                                                    'brvbar',
                                                                                    'copy',
                                                                                    'laquo',
                                                                                    'reg',
                                                                                    'plusmn',
                                                                                    'micro',
                                                                                    'para',
                                                                                    'middot',
                                                                                    'raquo',
                                                                                    'nbsp'
                                                                                );
                                                                                $pdf = $parser->parseFile($First_FileDestination);
                                                                                $pages = $pdf->getPages(['layout']);;

                                                                                foreach ($pages as $page) {

                                                                                    $File_one = implode(",", preg_split("/[\s]	+/", $page->getText()));

                                                                                    ?>
                                                                                    <p class="content">
                                                                                        <?php

                                                                                        echo $File_one; ?>
                                                                                    </p>

                                                                                    <?php

                                                                                }

                                                                            }


                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div>


                                            <?php

                                        }

                                        ?>

                                    </div>


                                    <?php
                                    ?>


                                    <?php
                                    ?>

                                    <div class="clearfix"></div>

                                    <?php


                                }

                                ?>


                            </div>


                        </div>
                    </div>
                    <!--------------------------------------------- view file end ------------------------------------->





                    <!----------------------------------------- view file star----------------------------------------->
                    <div id="category" class="tab-pane fade view_file_tab_content">
                        <div class="FileViewThumbnail ">




                           <div class="col-md-6 "  style="padding: 0">
                               <h3>Add Category</h3>
                               <form action="dashboard.php" method="post">
                                   <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                    <div class="clear-fix"></div>
                                   <br>
                                   <input type="submit" value="Add" name="save">
                               </form>

                           </div>
                            <div class="col-md-6" >
                                <h3>Category List</h3>
                                <?php
                                while ($row_category_name = mysqli_fetch_assoc($category_result_for_show)){

                                    ?>
                                    <p><?php echo $row_category_name['name']?></p>
                                <?php



                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <!--------------------------------------------- view file end ------------------------------------->



                </div>
            </div>

            <!---------------------------------------- ---------tab content end ------------------------------------->


        </div>
    </div>
</section>
<!-----------------------------------------------Box Section end --------------------------------------------------->


<?php
include 'template/footer_layout.php';
?>

<script>
    var i = window.location.hash;


    if (i.length > 0) {
        $('.main_body_profile .menubox .menu li ' + i).click(function (e) {
            $(this).click();
            console($(this));
        });
    }
    $(".file_name a").filter(function () {
        return $(this).attr("href").match(/\.(pdf|doc|docx|ppt|pptx|xls|txt|rtf)$/i);
    }).attr('target', '_blank');


    $(".overflow_text").mCustomScrollbar({
        advanced: {
            updateOnContentResize: true
        }
    });
</script>
</body>
</html>