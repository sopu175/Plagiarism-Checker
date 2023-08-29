<?php
$con = mysqli_connect("localhost", "root", "", "bubt");
// Check connection

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (!mysqli_set_charset($con, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($con));
    exit();
}
?>
