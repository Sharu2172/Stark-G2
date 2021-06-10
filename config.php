<?php
include("Session.php");
$host = "localhost";
$user = "root";
$pass = "";
$name = "IMS";

$conn = mysqli_connect($host, $user, $pass, $name); //host_name,username,password,Database_name
//check connection
if (!$conn) {
    echo "<script>console.log('Connection Failed'); </script>";
} else {
    echo modal("sucess", "empty", "Connection Sucessful", "blank");
}
