<?php

include "db/extra.php";



$sql2 = "SELECT * FROM file where id='$docID'";
$result = mysqli_query($con, $sql2);
$firstFile="";
$SecondFile="";
while ($row = mysqli_fetch_assoc($result)){
    $firs_file_id = $row['id'];
    $firstDestination = $row['destination'];
    $FirstFileName = $row['filename'];
}

$forAllSQL = "SELECT * FROM file";
$resultForAll = mysqli_query($con, $forAllSQL);
$user_pass = $_SESSION['password'];




if(isset($_POST['submit'])){
    $id = $_POST['idfile'];
    $SQL = "Delete * from file where id = '".$docID."'";



    $retval = mysqli_query( $SQL, $con );

    if(! $retval ) {
        die('Could not delete data: ' . mysqli_query());
    }
    else
        header('Location:profile.php');
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compare File</title>
    <?php
    include 'template/header_layout.php';
    ?>


</head>
<body>
<?php include 'template/header.php' ?>
<!-- Box Section Start -->
<section class="main_body_profile">

    <div class="container main-wrapper">
        <div class="Flex">
            <!------------------------------------------ menu box ----------------------------------------------------->
            <div class="col-md-3 right_sidebar mCustomScrollbar">
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
                            <a  href="../dashboard.php" class="menuitem">

                                <p><span><i class="fa fa-user" aria-hidden="true"></i></span>Pending File</p>

                            </a>
                        </li>

                        <li>
                            <a  href="../dashboard.php" class="menuitem" id="viewfile">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span>Files</p>


                            </a>
                        </li>

                        <li>
                            <a  href="../dashboard.php" class="menuitem" id="categoryy">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span>Add Category</p>


                            </a>
                        </li>
                        <li>
                            <a id="logout" href="../index.php" class="menuitem">

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


                    <!----------------------------------------- view file star----------------------------------------->
                    <div id="view_files" class="tab-pane fade active view_file_tab_content">
                        <div class="FileViewThumbnail ">
                            <ul class="FilterNav">
                                <li><a id="all" class="active" data-filter="*" href="javascript:">All</a></li>
                                <li><a data-filter=".myfiles" href="javascript:">My Files</a></li>
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

                                                        <a  href="select_file.php?docID=<?php echo $row['id'] ?>">

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
                                                                    <p>Compare File</p>
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

                                                                                $pdf = $parser->parseFile($First_FileDestination);
                                                                                $pages = $pdf->getPages();
                                                                                foreach ($pages as $page) {
                                                                                    $File_one = implode("/", preg_split("/[\s]	+/", $page->getText()));

                                                                                    ?>
                                                                                    <p class="content">
                                                                                        <?php echo $File_one; ?>
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


                    <?php include 'template/right_side_main_no_active.php'?>

                </div>
            </div>

            <!---------------------------------------- ---------tab content end ------------------------------------->




        </div>
    </div>









</section>
<!-- Box Section End -->

<?php include 'template/footer.php'?>


<?php include 'template/footer_layout.php'?>
</body>
</html>