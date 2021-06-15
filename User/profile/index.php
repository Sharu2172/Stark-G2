<?php
require("../extra/header.php");
$query = "SELECT * FROM user where uid = '$_COOKIE[uid]'";
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
                        if ($row['image'] == "") {
                            echo "<img src='https://via.placeholder.com/500' class='img-thumbnail' width=150px height=150px>";
                        } else {
                            echo "<img src='../../images/" . $row['image'] . "' class='img-thumbnail' style='width:20%'>";
                        }
                        ?>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="inputname" class="col-sm-5 col-form-label"><b>User Name</b></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="inputname" value="<?php echo $row['uname']; ?>">
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
            <button type="button" class="btn btn-success btn-outline-light" data-toggle="modal" data-target="#edit-details">
                Edit Details
            </button>
        </div>
        <!-- This modal display's form for editing Admin Data. -->
        <div class="modal fade" id="edit-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <form action='profile.php' method='POST' enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="inputimage" class="col-sm-5 col-form-label"><b>User Image : </b></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" name="image" id="inputimage">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputname" class="col-sm-5 col-form-label"><b>User Name : </b></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputname" name='name' value="<?php echo $row['uname']; ?>" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputemail" class="col-sm-5 col-form-label"><b>Email</b></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="inputemail" required name="email" value="<?php echo $row['email']; ?>" title=" please enter a valid email address" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" id="inputemail">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputph" class="col-sm-5 col-form-label"><b>Phone Number : </b></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" required id="inputph" name="ph_no" value="<?php echo $row['ph_no']; ?>" title="Please enter a valid Phone Number." pattern="^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" id="inputph">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputdob" class="col-sm-5 col-form-label"><b>Date of Birth : </b></label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" required id="inputdob" name="dob" value="<?php echo $row['dob']; ?>" title="Please enter a valid Phone Number." pattern="^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" id="inputph">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputgn" class="col-sm-5 col-form-label"><b>Gender : </b></label>
                                <div class="col-sm-5">
                                    <select class="form-select" id="inputgn" name="gender">
                                        <option selected value="<?php echo $row['gender']; ?>"><?php echo $row['gender']; ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Not_Selected">Not Slected</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="inputadd" class="col-sm-5 col-form-label"><b>Address : </b></label>
                                <div class="col-sm-5">
                                    <textarea class="form-control" id="inputadd" name="address" rows="3"><?php echo $row["address"]; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Close </button>
                            <button type="submit" class="btn btn-outline-primary"> Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </center>
</main>

<?php
require("../extra/footer.php");
?>