<?php
require("../extra/header.php");
if (!empty($_POST['search'])) {
    $pid = $_POST['search'];
    if (is_numeric($pid)) {
        $query = "SELECT * FROM stocks WHERE pid = $pid";
    } elseif (ctype_alnum($pid)) {
        $query = "SELECT * FROM stocks WHERE product LIKE '%$pid%' ORDER BY brand ASC";
    }
    $query_run = mysqli_query($conn, $query);
    if ($query_run->num_rows > 1) { ?>
        <center>
            <h2>Products</h2>
        </center>
        <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
            <form action="../search/index.php" method='POST'>
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
                                <button name="search" id="search" type="submit" class="btn btn-primary" value="<?php echo $row['pid']; ?>"> Go somewhere</button>
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
        <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
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
            <?php if ($row['no'] > 0) { ?>
                <button type="button" class="btn btn-primary justify-content-center" data-bs-toggle="modal" data-bs-target="#purchase">
                    Purchase
                </button>
            <?php } else { ?><button type="button" class="btn btn-secondary justify-content-center" disabled>
                    Out of Stock
                </button>
            <?php } ?>
        </main>
        <div class="modal fade" id="purchase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Purchase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='$("#purchase").modal("hide");'>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <form action='../extra/add.php' method='post' enctype="multipart/form-data">
                        <div class="modal-body">
                            Product : <?php echo $row['pname'] ?>
                            <br>
                            Avilable Quantity : <?php echo $row['no'] ?>
                            <br>
                            <label for="quantity">Required Quantity : </label>
                            <input type="number" id="quantity" name="quantity" placeholder="Enter Qantity" min="1" max="<?php echo $row['no']; ?>" required>
                            <br>
                            <input type="text" id="pid" name="pid" value='<?php echo $row['pid'] ?>' hidden>
                            <input type="text" id="uid" name="uid" value='<?php echo $_SESSION['uid'] ?>' hidden>
                            <input type="text" id="cost" name="cost" value='<?php echo $row['cost'] ?>' hidden>
                            <input type="text" id="no" name="no" value='<?php echo $row['no'] ?>' hidden>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='$("#purchase").modal("hide");'> Close </button>
                            <button type="submit" class="btn btn-primary"> Purchase </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php    }
} else {
    echo location("../dashboard/");
}
require("../extra/footer.php");
?>