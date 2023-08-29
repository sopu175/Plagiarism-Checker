<?php

include "db/extra.php";


$docID = $_GET['docID'];
$sql2 = "SELECT * FROM pending where id='$docID'";
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
<body class="admin">

<nav class="navbar navbar-dark bg-dark">
    <ul class="navbar-nav">
        <li class="nav-item active"><a class="nav-link" href="#">Dashboard</a></li>
    </ul>
</nav>
<!-- Box Section Start -->
<section class="main_body_profile">

    <div class="container main-wrapper">
        <div class="">
            <!------------------------------------------ menu box ----------------------------------------------------->
            <div class="col-md-3 right_sidebar">

                <div class="menubox">
                    <ul class="  menu">
                        <li class="">
                            <a  href="dashboard.php" class="menuitem">

                                <p><span><i class="fa fa-user" aria-hidden="true"></i></span>Pending File</p>

                            </a>
                        </li>

                        <li>
                            <a  href="dashboard.php" class="menuitem" id="viewfile">

                                <p><span>  <i class="fa fa-file" aria-hidden="true"></i></span>Files</p>


                            </a>
                        </li>

                        <li>
                            <a  href="dashboard.php" class="menuitem" id="categoryy">

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

            <div class="col-md-8 profile_content_body  mCustomScrollbar" data-mcs-theme="dark">
                <div class="tab-content">

                    <!-------------------------------------------- select first file ---------------------------------->
                    <div id="file_check" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-6  FileTwo">
                                <h4>Select File Which You Want To Check</h4>
                                <div class="select_File ">
                                    <form action="file_checker/admin_file_check.php" method="post" class="">
                                        <div class="form-group Select">
                                            <select class=""  id="section" name="SecondFileDestination">
                                                <option class="option" data-display="Select File" value="0" name="SecondFileDestination">--Select File--</option>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($resultForAll)) {
                                                    //echo $row['filename'];
                                                    $des=  $row['destination'];
                                                    echo "<option value='".$des. "'>".$row['filename']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" value='<?php echo $firstDestination?>' name="myFileDestination">
                                        <button type="submit" class="btn btn-block " name="submit">Check</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 FileOne">
                                <?php
                                $extension = pathinfo($FirstFileName, PATHINFO_EXTENSION);
                                ?>
                                <div class="col-md-3 file_image"
                                    <?php
                                    if ($extension == "docx") {
                                        echo 'style="background-image: url(\'assets/image/thumb/doc.jpg\')"';
                                    }
                                    if ($extension == "pdf") {
                                        echo 'style="background-image: url(\'assets/image/thumb/pdf.jpg\')"';
                                    }
                                    if ($extension == "txt") {
                                        echo 'style="background-image: url(\'assets/image/thumb/images.jfif\')"';
                                    }


                                    ?>
                                >

                                </div>
                                <p class="file-title"><?php
                                    echo $FirstFileName;
                                    ?></p>

                                <form action="delete.php" method="post">

                                    <input type="text" hidden="true" name="idfile" value="<?php echo $docID ?>">
                                    <input type="submit" value="Delete">
                                </form>

                            </div>

                        </div>
                    </div>
                    <!--------------------------------------- select first file --------------------------------------->

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