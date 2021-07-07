<?php
include('../../config.php');
//To allow only admin's to access this page
echo AAccess();

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];

    $oldqry = "SELECT pimage FROM stocks WHERE pid='$pid'";
    $qry_run121 = mysqli_query($conn, $oldqry);
    $olddata = mysqli_fetch_assoc($qry_run121);

    $query = "DELETE FROM stocks WHERE pid = '$pid'";
    if (!empty($olddata['pimage'])) {
        unlink('../../assets/image/product/' . $olddata['pimage']);
    }

    //to check if Query is Run sucessfully
    if ($conn->query($query)) {
        echo "<script type='text/javascript'>alert('Product Removed Sucessfully.');</script>";
        echo location("../dashboard/index.php");
    } else {
        echo "<script type='text/javascript'>alert('Cannot Remove Product.');</script>";
        echo location("index.php", "search',$pid");
    }
} else {
    echo location("../dashboard/index.php");
}
