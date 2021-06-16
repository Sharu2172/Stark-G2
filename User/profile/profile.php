
<?php
include('../../config.php');

//To allow only admin's to access this page
echo Access();

//Store POST array to variables
$name = $_POST['name'];
$ph_no = $_POST['ph_no'];
$dob = date($_POST['dob']);
$gender = $_POST['gender'];
$address = $_POST['address'];
$image = "";

$oldqry = "SELECT image FROM user WHERE uid='$_SESSION[uid]'";
$qry_run121 = mysqli_query($conn, $oldqry);
$olddata = mysqli_fetch_assoc($qry_run121);

//To check if Admin Image is selected to update
if (empty($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
    //To check if password is set for update...
    $query = "UPDATE user SET uname='$name',dob='$dob',gender='$gender',ph_no='$ph_no',address='$address' WHERE uid='$_SESSION[uid]'";
} else {
    $temp = explode(".", $_FILES["image"]["name"]);
    $image = round(microtime(true)) . '.' . end($temp);
    $query = "UPDATE user SET uname='$name',dob='$dob',gender='$gender',ph_no='$ph_no',address='$address',image='$image' WHERE uid='$_SESSION[uid]'";
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../assets/image/user/" . $image);
    if (!empty($olddata['image'])) {
        unlink('../../assets/image/user/' . $olddata['image']);
    }
}

//to check if Query is Run sucessfully
if ($conn->query($query)) {
    echo "<script type='text/javascript'>alert('User Details Edited Sucessfully.');</script>";
    $_SESSION['name'] = $name;
    $_SESSION['image'] = $image;
    echo location("../dashboard/index.php");
} else {
    if ($conn->errno == 1062) {
        echo "<script type='text/javascript'>alert('Duplicate entry for " . $name . ".');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Cannot Edit User Details');</script>";
    }
    echo location("index.php");
}
?>