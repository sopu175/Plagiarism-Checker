<?php
session_start();
include "db/dbconfig.php";
$user_Id = $_SESSION['id'];
$sql = "SELECT * FROM file where user_id='$user_Id'";
$result = mysqli_query($con, $sql);


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View File</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link rel="stylesheet" href="assets/css/solid.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
<!-- Preloader Start-->
<div class="preloader-wrapper">
    <div class="preloader">
        <img src="assets/image/1.png">
        <h2>please wait...</h2>
    </div>
</div>
<!-- Preloader End-->
<!-- Box Section Start -->
<div class="container-fluid">
    <div class="container main-wrapper">
        <div class="row">
            <div class="col-md-12 inner-div ">
                <img class="main-logo" src="assets/image/1.png" alt="">
                <p class="bubt-title"><strong>Bangladesh University of Business & Technology</strong></p>
                <div class="row menubox">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Box Section End -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="assets/js/solid.js"></script>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>