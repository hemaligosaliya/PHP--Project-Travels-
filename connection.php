<?php
session_start();
ob_start();
$con = new mysqli("localhost", "root", "hello", "thejourney");

if (mysqli_connect_error()) {
    die("Not Connected..!" . mysqli_connect_error() . mysqli_connect_errno());
}

?>