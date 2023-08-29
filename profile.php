<?php
include 'db/extra.php';
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php
        if ($name == null) {
            echo $user_Id;
        } else {
            echo $name;
        }
        ?></title>

    <?php
        include 'template/header_layout.php';
    ?>

    <style>

    </style>
</head>
<body class="body-width">

<div id="loading">
    <img id="loading-image" src="assets/image/ajaxloader.gif" alt="Loading..."/>
</div>

<?php include 'template/header.php' ?>

<!-----------------------------------------------Box Section Start --------------------------------------------------->
<section class="main_body_profile">

    <div class="container main-wrapper">
        <div class="Flex">

            <!---------------------------------------- ---------tab content start ------------------------------------->
            <div class="col-md-12 profile_content_body  mCustomScrollbar" data-mcs-theme="dark">
                <div class="tab-content">

                    <?php include 'template/right_side_main.php'?>

                </div>
            </div>

            <!---------------------------------------- ---------tab content end ------------------------------------->


        </div>
    </div>
</section>
<!-----------------------------------------------Box Section end --------------------------------------------------->


<?php include 'template/footer.php'?>


<?php include 'template/footer_layout.php'?>

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