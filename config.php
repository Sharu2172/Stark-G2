<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "IMS";

$conn = mysqli_connect($host, $user, $pass, $name); //host_name,username,password,Database_name
//check connection
if (!$conn) {
    echo "connection failed: " . mysqli_connect_error();
    echo `<script>
    console.log("Connection failed");
    </script>`;
}
