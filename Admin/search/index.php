<?php
require("../extra/header.php");
if (!empty($_POST['search'])) {
    $pid = $_POST['search'];
    if (is_numeric($pid)) {
        $query = "SELECT * FROM stocks WHERE pid = $pid";
    } elseif (ctype_alnum($pid)) {
        $query = "SELECT * FROM stocks WHERE pname LIKE '%$pid%' ORDER BY brand ASC";
    }
    $query_run = mysqli_query($conn, $query);
    if ($query_run->num_rows > 1) { ?>
        <center>
            <h2>Products</h2>
        </center>
        <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
            <form action="index.php" method='POST'>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                        <div class="col-sm-3">
                            <div class="card">
                                <?php
                                if ($row['pimage'] == "" || !file_exists('../../assets/image/product/' . $row["pimage"])) {
                                    echo "<img src='https://via.placeholder.com/1080' class='card-img-top' width=150px height=150px>";
                                } else {
                                    echo "<img src='../../assets/image/product/" . $row['pimage'] . "' class='card-img-top'>";
                                }
                                ?>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Product : <?php echo $row['pname']; ?></li>
                                    <li class="list-group-item">Brand : <?php echo $row['brand']; ?></li>
                                    <li class="list-group-item">Price : <?php echo $row["cost"]; ?></li>
                                    <li class="list-group-item">Quantity : <?php echo $row["no"]; ?></li>
                                </ul>
                                <button name="search" id="search" type="submit" class="btn btn-primary" value="<?php echo $row['pid']; ?>"> Details </button>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </main>
    <?php } else if ($query_run->num_rows == 1) {
        $row = mysqli_fetch_assoc($query_run);
    ?>
        <center>
            <h3><u><?php echo $row["pname"]; ?></u></h3>
        </center>
        <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4 justify-content-center">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php
                    if ($row['pimage'] == "" || !file_exists('../../assets/image/product/' . $row["pimage"])) {
                        echo "<img src='https://via.placeholder.com/150' class='d-block w-50'>";
                    } else {
                        echo "<img src='../../assets/image/product/" . $row['pimage'] . "' class='d-block w-75'>";
                    }
                    ?>
                </div>
            </div>
            <hr class=" dropdown-divider">
            <div class="container">
                <h2 class=" text-center"><u><?php echo $row['pname'] ?></u></h2>
                <br>
                Description : <?php echo $row["Description"] ?>
                <br>
                Cost : <?php echo $row["cost"] ?>
            </div>
            <hr class=" dropdown-divider">
            <center>
                <div class="row text-center justify-content-center">
                    <button type="button" class="btn btn-primary col-3" data-bs-toggle="modal" data-bs-target="#edit-product">
                        Edit Product
                    </button>
                    <button type="button" class="btn btn-danger col-3" data-bs-toggle="modal" data-bs-target="#remove-product">
                        Remove Product
                    </button>
                </div>
            </center>

            <div class="modal fade" id="edit-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Product Details</h5>
                            <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close" onclick='$("#edit-product").modal("hide");'>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <form action='edit.php' method='POST' enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="text" name='pid' value="<?php echo $row['pid']; ?>" hidden>
                                <div class="form-group row">
                                    <label for="updateimage" class="col-sm-5 col-form-label"><b>Product Image : </b></label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="image" id="updateimage">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="updatename" class="col-sm-5 col-form-label"><b>Product Name : </b></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="updatename" name='name' value="<?php echo $row['pname']; ?>" required>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="updatedesc" class="col-sm-5 col-form-label"><b>Product Description : </b></label>
                                    <div class="col-sm-5">
                                        <textarea class="form-control" id="updatedesc" name="Description" rows="3"><?php echo $row["Description"]; ?></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="updatebrand" class="col-sm-5 col-form-label"><b>Product Brand : </b></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" required id="updatebrand" name="brand" value="<?php echo $row['brand']; ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="updateno" class="col-sm-5 col-form-label"><b>Product Quantity: </b></label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" required id="updateno" name="no" value="<?php echo $row['no']; ?>">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="updatecost" class="col-sm-5 col-form-label"><b>Unit Cost : </b></label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" required id="updatecost" name="cost" value="<?php echo $row['cost']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal" onclick='$("#edit-product").modal("hide");'> Close </button>
                                <button type="submit" class="btn btn-outline-primary"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="remove-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Remove Product</h5>
                            <button type="button" class="close bg-transparent border-0" data-dismiss="modal" aria-label="Close" onclick='$("#remove-product").modal("hide");'>
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Modal Body -->
                        <form action='remove.php' method='POST' enctype="multipart/form-data">
                            <div class="modal-body">
                                Are Yoy sure to remove product <?php echo $row['pname']; ?> .
                                <input type="text" name='pid' value="<?php echo $row['pid']; ?>" hidden>
                            </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal" onclick='$("#remove-product").modal("hide");'> Close </button>
                                <button type="submit" class="btn btn-outline-primary"> Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
<?php    }
} else {
    echo location("../dashboard/");
}
require("../extra/footer.php");
?>