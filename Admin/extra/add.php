<?php
include('../../config.php');
AAccess();
if (isset($_POST['name'])) {
    $image = "";
    $name = $_POST['name'];
    $desc = $_POST['Description'];
    $brand = $_POST['brand'];
    $no = $_POST['no'];
    $cost = $_POST['cost'];

    if (empty($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        //To check if password is set for update...
        $query = "INSERT INTO stocks(brand, pname, Description, no, cost) VALUES ('$brand','$name','$desc','$no','$cost')";
    } else {
        $temp = explode(".", $_FILES["image"]["name"]);
        $image = round(microtime(true)) . '.' . end($temp);
        $query = "INSERT INTO stocks(brand, pname, pimage, Description, no, cost) VALUES ('$brand','$name','$image','$desc','$no','$cost')";
        move_uploaded_file($_FILES["image"]["tmp_name"], "../../assets/image/product/" . $image);
    }
    $result = $conn->query($query);
    if ($result) {
        echo "<script type='text/javascript'>alert('Product Added Sucessfully');</script>";
        echo location("../dashboard/index.php");
    } else {
        echo "<script type='text/javascript'>alert('Cannot Add Product. Please try again later...');</script>";
        echo location("../dashboard/index.php");
    }
} else {
    echo location("../dashboard/index.php");
}
