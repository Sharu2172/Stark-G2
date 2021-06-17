<?php
include('../extra/header.php');
Access();
if (isset($_POST['pid']) && isset($_POST['quantity'])) {
    $uid = $_SESSION["uid"];
    $pid = $_POST["pid"];
    $quantity = $_POST["quantity"];
    $amount = $cost * $quantity;

    $sql = "INSERT INTO transaction(uid, pid, quantity, total) VALUES ('$uid', '$pid', '$quantity', '$amount')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Transaction Sucessful');</script>";
        echo location("Generate.php", "pid", $pid, "quantity", $quantity);
    } else {
        echo "<script type='text/javascript'>alert('Cannot Complete transaction. Please try again later...');</script>";
        echo location("../search/index.php", "search", $pid);
    }
} else {
    echo location("../dashboard/index.php");
}
?>
<div class=" text-center">
    <h2>Murgesh Distributors</h2>
</div>
<?php
include('../extra/footer.php');
?>