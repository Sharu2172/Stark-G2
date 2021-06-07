<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "IMS";

$conn = mysqli_connect($host, $user, $pass, $name); //host_name,username,password,Database_name
//check connection
if (!$conn) {
    echo "<script>console.log('Connection Failed'); </script>";
} else {
    echo "<script>console.log('Connection Sucessful'); </script>";
}

//Function to redirect user to another page with preset post variables.
function location($page, $name1 = "", $value1 = "", $name2 = "", $value2 = "")
{
    $out = '
<form method="POST" id="form_id" action="' . $page . '">
<input type="text" name="' . $name1 . '" value="' . $value1 . '" hidden>
<input type="text" name="' . $name2 . '" value="' . $value2 . '" hidden>
</form>
<script type="text/javascript">document.forms[\'form_id\'].submit();</script>
';
    echo $out;
}

//Function to only allow user's to access specific files using session array.
function Access()
{
    if (!isset($_SESSION['uid'])) {
        echo "<script type='text/javascript'>alert('Please Login to Access This Page.');</script>";
        echo location("../");
    }
}
