<?php
include('../../config.php');
Access();
if (isset($_POST['uid'])) {
    $uid = $_POST["uid"];
    $pid = $_POST["pid"];
    $quantity = $_POST["quantity"];
    $cost = $_POST["cost"];
    $amount = $cost * $quantity;

    $sql = "INSERT INTO transaction(uid, pid, quantity, cost) VALUES ('$uid', '$pid', '$quantity', '$amount')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Transaction Sucessful');</script>";
        echo location("../search/index.php", "search", $pid);
    } else {
        echo "<script type='text/javascript'>alert('Cannot Complete transaction. Please try again later...');</script>";
        echo location("../search/index.php", "search", $pid);
    }
} else {
    echo location("../search/index.php", "search", $pid);
}
