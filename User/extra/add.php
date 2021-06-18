<?php
include('../../config.php');
Access();
if (isset($_POST['uid'])) {
    $uid = $_POST["uid"];
    $pid = $_POST["pid"];
    $no = $_POST["no"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $bal = $no - $quantity;
    $amount = $cost * $quantity;
    $id = time();
    $sql = "INSERT INTO transaction(id,uid, uname, pid, pname,brand,cost, quantity, total) VALUES ('$id','$uid',(SELECT uname FROM user WHERE uid='$uid'),'$pid',(SELECT pname FROM stocks WHERE pid='$pid'),(SELECT brand FROM stocks WHERE pid='$pid'),(SELECT cost FROM stocks WHERE pid='$pid'), '$quantity', '$amount')";
    $result = $conn->query($sql);
    if ($result) {
        $sql1 = "UPDATE stocks SET no = '$bal' WHERE pid=$pid";
        $conn->query($sql1);
        echo "<script type='text/javascript'>showMessage('Transaction Sucessful');</script>";
        echo location("../bill/index.php", "iid", $id);
    } else {
        echo "<script type='text/javascript'>alert('Cannot Complete transaction. Please try again later...');</script>";
        echo location("../search/index.php", "search", $pid);
    }
} else {
    echo location("../dashboard/index.php");
}
