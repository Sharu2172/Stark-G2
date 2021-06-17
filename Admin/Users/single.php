<?php
require("../extra/header.php");
if (!isset($_POST['uid'])) {
    echo location('index.php');
}
$query = "SELECT * FROM user where uid = '$_POST[uid]'";
$query_run = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query_run)
?>
<!-- This HTML Page display's Admin Data to the user -->
<main class="col-md-auto ms-sm-auto col-lg-auto px-md-15 justify-content-center">
    <center>
        <div class="container">
            <h3><b><u>User Details</u></b></h3>
            <fieldset disabled>
                <div class="form-group">
                    <div class="thumbnail">
                        <?php
                        if (!isset($row['image']) || ($row['image'] == "" || !file_exists('../../assets/image/user/' . $row['image']))) {
                            echo "<img src='https://via.placeholder.com/500' class='img-thumbnail' width=150px height=150px>";
                        } else {
                            echo "<img src='../../assets/image/user/" . $row['image'] . "' class='img-thumbnail' style='width:20%'>";
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputname" class="col-sm-5 col-form-label"><b>User Name</b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputname" value="<?php if (isset($row['uname'])) {
                                                                                            echo $row['uname'];
                                                                                        } ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputemail" class="col-sm-5 col-form-label"><b>Email</b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputemail" value="<?php echo $row['email']; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputph" class="col-sm-5 col-form-label"><b>Phone Number : </b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputph" value="<?php echo $row['ph_no']; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputdob" class="col-sm-5 col-form-label"><b>Date of Birth : </b></label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" id="inputdob" value="<?php echo $row['dob']; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputgn" class="col-sm-5 col-form-label"><b>Gender : </b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputgn" value="<?php echo $row['gender']; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputadd" class="col-sm-5 col-form-label"><b>Address : </b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputadd" value="<?php echo $row['address']; ?>">
                    </div>
                </div>
            </fieldset>
            <br>
            <form action="transaction.php" method="POST">
                <button type="submit" class="btn btn-primary" value="<?php echo $row['uid']; ?>" name="uid">
                    Transactions
                </button>
            </form>
        </div>
    </center>
</main>

<?php
require("../extra/footer.php");
?>