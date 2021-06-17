
<?php
include('../../config.php');
//To allow only admin's to access this page
echo AAccess();
if (isset($_POST['pid'])) {
    //Store POST array to variables
    $image = "";
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $desc = $_POST['Description'];
    $brand = $_POST['brand'];
    $no = $_POST['no'];
    $cost = $_POST['cost'];

    $oldqry = "SELECT pimage FROM stocks WHERE pid='$pid'";
    $qry_run121 = mysqli_query($conn, $oldqry);
    $olddata = mysqli_fetch_assoc($qry_run121);

    //To check if Admin Image is selected to update
    if (empty($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        //To check if password is set for update...
        $query = "UPDATE stocks SET brand='$brand',pname='$name',Description='$desc',no='$no',cost='$cost' WHERE pid = '$pid'";
    } else {
        $temp = explode(".", $_FILES["image"]["name"]);
        $image = round(microtime(true)) . '.' . end($temp);
        $query = "UPDATE stocks SET brand='$brand',pname='$name',Description='$desc',no='$no',cost='$cost',pimage='$image' WHERE pid = '$pid'";
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../assets/image/product/" . $image);
        if (!empty($olddata['pimage'])) {
            unlink('../../assets/image/product/' . $olddata['pimage']);
        }
    }

    //to check if Query is Run sucessfully
    if ($conn->query($query)) {
        echo "<script type='text/javascript'>alert('Product Details Edited Sucessfully.');</script>";
        $oldqry = "UPDATE transaction SET pname='$name' WHERE pid='$pid'";
        mysqli_query($conn, $oldqry);
        echo location("index.php", "search", $pid);
    } else {
        echo "<script type='text/javascript'>alert('Cannot Edit User Details');</script>";
        echo location("index.php", "search", $pid);
    }
} else {
    echo location("../dashboard/index.php");
}

?>