<?php
include('../../config.php');
Access();
if (isset($_POST['uid'])) {
    $uid = $_POST["uid"];
    $pid = $_POST["pid"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $amount = $cost * $quantity;
    $id = time();
    $sql = "INSERT INTO transaction(id,uid, uname, pid, pname, quantity, total) VALUES ('$id','$uid',(SELECT uname FROM user WHERE uid='$uid'),'$pid',(SELECT product FROM stocks WHERE pid='$pid'), '$quantity', '$amount')";
    $result = $conn->query($sql);
    if ($result) {
        $sql1 = "UPDATE stocks SET no = (SELECT no FROM stocks WHERE pid=$pid)-$quantity WHERE pid=$pid";
        $conn->query($sql1);
        echo "<script type='text/javascript'>alert('Transaction Sucessful');</script>";
        echo location("../bill/index.php", "iid", $id);
    } else {
        echo "<script type='text/javascript'>alert('Cannot Complete transaction. Please try again later...');</script>";
        echo location("../search/index.php", "search", $pid);
        echo $conn->errno;
    }
} else {
    echo location("../dashboard/index.php");
}
