
<!----------------------------------------- profile details --------------------------------------->
<div id="profiel_details" class="tab-pane fade in active">
    <div class="row">
        <div class="profile_info_table ">
            <h3>Profile Information</h3>

            <div class="profile_info_table_wrapp">
                <div class="image_wrapper" style="margin-bottom: 20px;">
                    <?php
                        if ($image == null){
                            ?>
                            <img  style="height: 250px;"    src="uploads/user/download.png" alt="">

                            <?php
                        }
                        else{
                            ?>
                            <img style="height: 250px;"  src="<?php echo $image ?>" alt="">

                            <?php
                        }

                    ?>



                </div>


                <table>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $name ?></td>
                    </tr>
                    <tr>
                        <td>ID</td>
                        <td><?php echo $user_Id ?></td>
                    </tr>
                    <tr>
                        <td>Intake</td>
                        <td><?php echo $intake ?></td>
                    </tr>
                    <tr>
                        <td>Section</td>
                        <td><?php echo $section ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></td>
                    </tr>
                    <tr>
                        <td>Mobile No. &nbsp;&nbsp;</td>
                        <td><a href="tel:<?php echo $phone ?>"><?php echo $phone ?></a></td>
                    </tr>
                </table>
            </div>


            <div class="others_info">

                <ul>
                    <li>
                        <form action="user_module/upload_image.php" method='POST' enctype='multipart/form-data'>
                            <label for="img">Click me to upload profile picture</label>
                            <input type="file" name="myFile">
                            <input type="submit"  name="upload" class="submit_upload">
                        </form>
                    </li>
                    <p style="    font-size: 18px;text-decoration: underline;font-weight: 500;">General Setting</p>
                    <li> <p ><a href="" data-toggle="modal" data-target="#myModal" style="color: #000000">Change Account Information</a></p></li>
                    <li> <p ><a href="" data-toggle="modal" data-target="#myModal2" style="color: #000000">Change Password</a></p></li>
                    <li> <p ><a href="" data-toggle="modal" data-target="#myModal" style="color: #a70e1d">Delete Account</a></p></li>
                </ul>

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Update Your Profile Information</h4>
                            </div>
                            <div class="modal-body">
                                <form action="user_module/update_info.php" method="post" class="">
                                    <div class="form-group">
                                        <input type="text" id="name)" class="form-control" name="name" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="id" class="form-control" name="id" placeholder="Institutional ID">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" id="intake" name="intake" class="form-control" placeholder="Intake">
                                    </div>
                                    <div class="form-group">

                                        <input type="number" id="section" name="section" class="form-control" placeholder="Section">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                                    </div>



                                    <div class="form-group">
                                        <input type="tel" id="phone" class="form-control" name="phone" placeholder="Mobile Number">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" id="submit" class="form-control asSubmitSignup" name="submit">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


                <div id="myModal2" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Update Your Password</h4>
                            </div>
                            <div class="modal-body">
                                <form action="user_module/update_password.php" method="post" class="">
                                    <div class="form-group">

                                        <input type="tel" id="password" class="form-control" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <input type="tel" id="confirm_p" class="form-control" name="cp_password" placeholder="Confirm Password">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" id="submit" class="form-control asSubmitSignup" name="submit">
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!--------------------------- profile details end ------------------------------------------------->


<!--------------------------------------upload file ----------------------------------------------->
<div id="upload_files" class="tab-pane fade upload_file">
    <div class="row">
        <div class="upload_wrapper">
            <h3>Upload File</h3>
            <form action="user_module/upload_file_progress.php" method="post"
                  enctype="multipart/form-data">

                <div class="form-group Select">
                    <label for="categroy">Select Category</label>
                    <div class="clearfix"></div>
                    <select name="category" id="categroy" class="form-control">
                        <?php

                        while (($row2 = mysqli_fetch_assoc($category_result))) {
                            ?>

                            <option value="<?php echo $row2['id'] ?>">

                                <?php
                                echo $row2['name'];
                                ?>
                            </option>

                            <?php

                        }


                        ?>

                    </select>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <label for="file">Select your file</label>
                    <div class="clearfix"></div>
                    <input type="file" id="file" class="form-control" name="myFile">
                </div>
                <button type="submit" name="save" style="margin-top: 15px">upload</button>
            </form>
        </div>
    </div>
</div>
<!----------------------------------------- upload file end --------------------------------------->


<!----------------------------------------- view file star----------------------------------------->
<div id="view_files" class="tab-pane fade view_file_tab_content">
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

                                        <a class="check_with_all_files" href="file_checker/check_file_all.php?docID=<?php echo $row['id'] ?>">Check With Files</a>

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



