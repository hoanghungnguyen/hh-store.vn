<?php
$con = mysqli_connect("localhost", "root", "", "hh_store");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_set_charset($con, "utf8");
