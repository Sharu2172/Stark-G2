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
    if ($query_run->num_rows > 1) {
        while ($row = mysqli_fetch_assoc($query_run)) {
?>
            <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
                <center>
                    <h2>Products</h2>
                </center>
                <form action="../search/index.php" method='POST'>
                    <div class="row">
                        <?php
                        // This query is used for reading student data from database.
                        $query = "SELECT * FROM `stocks` ORDER BY 'product' ASC;";
                        $query_run = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <div class="col-sm-3">
                                <div class="card">
                                    <img src="../../images/W3.jpg" class="card-img-top" alt="...">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Product : <?php echo $row['product']; ?></li>
                                        <li class="list-group-item">Brand : <?php echo $row['brand']; ?></li>
                                        <li class="list-group-item">Price : <?php echo $row["cost"]; ?></li>
                                    </ul>
                                    <button name="search" id="search" type="submit" class="btn btn-primary" value="<?php echo $row['pid']; ?>"> Go somewhere</button>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </form>
            </main>
        <?php
        }
    } elseif ($query_run->num_rows == 1) {
        $row = mysqli_fetch_assoc($query_run);
        ?>
        <main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../../images/W3.jpg" class="d-block w-75" alt="../W3.jpg">
                </div>
            </div>
            <hr class=" dropdown-divider">
            <div class="container">
                <h2 class=" text-center"><u><?php echo $row['product'] ?></u></h2>
                <br>
                <?php echo $row["Description"] ?>
            </div>
            <hr class=" dropdown-divider">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-cart">
                Launch demo modal
            </button>
        </main>
        <div class="modal fade" id="add-cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add To cart</h5>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <form action='../extra/add.php' method='post' enctype="multipart/form-data">
                        <div class="modal-body">
                            Product : <?php echo $row['product'] ?>
                            <br>
                            <br>
                            <input type="text" id="quantity" name="quantity" placeholder="Enter Qantity" required>
                            <br>
                            <input type="text" id="pid" name="pid" value='<?php echo $row['pid'] ?>' hidden>
                            <input type="text" id="uid" name="uid" value='<?php echo $_COOKIE['uid'] ?>' hidden>
                            <input type="text" id="cost" name="cost" value='<?php echo $row['cost'] ?>' hidden>
                        </div>
                        <!-- Modal Footer -->
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary"> Add to Cart </button>
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