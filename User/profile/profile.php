
<?php
include('../../config.php');

//To allow only admin's to access this page
echo Access();

//Store POST array to variables
$name = $_POST['name'];
$email = $_POST['email'];
$ph_no = $_POST['ph_no'];
$dob = date($_POST['dob']);
$gender = $_POST['gender'];
$address = $_POST['address'];

$oldqry = "SELECT image FROM user WHERE uid='$_COOKIE[uid]'";
$qry_run121 = mysqli_query($conn, $oldqry);
$olddata = mysqli_fetch_assoc($qry_run121);

//To check if Admin Image is selected to update
if (empty($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
    //To check if password is set for update...
    $query = "UPDATE user SET uname='$uname',dob='$dob',gender='$gender',ph_no='$ph_no',email='$email',address='$address' WHERE uid='$_COOKIE[uid]'";
} else {
    $temp = explode(".", $_FILES["image"]["name"]);
    $image = round(microtime(true)) . '.' . end($temp);
    $query = "UPDATE user SET uname='$name',dob='$dob',gender='$gender',ph_no='$ph_no',email='$email',address='$address',image='$image' WHERE uid='$_COOKIE[uid]'";
    move_uploaded_file($_FILES["image"]["tmp_name"], "../../images/" . $image);
    if (!empty($olddata['image'])) {
        unlink('../../images/' . $olddata['image']);
    }
}

//to check if Query is Run sucessfully
if ($conn->query($query)) {
    echo "<script type='text/javascript'>alert('User Detaails Edited Sucessfully.');</script>";
    //echo location("../dashboard/index.php");
} else {
    echo "<script type='text/javascript'>alert('Cannot Update User Details.');</script>";
    //echo location("index.php");
}
?>