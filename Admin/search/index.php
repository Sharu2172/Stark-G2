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
                                    <li class="list-group-item">Product : <?php echo $row['product']; ?></li>
                                    <li class="list-group-item">Brand : <?php echo $row['brand']; ?></li>
                                    <li class="list-group-item">Price : <?php echo $row["cost"]; ?></li>
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
            <h3><u><?php echo $row["product"]; ?></u></h3>
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
                <h2 class=" text-center"><u><?php echo $row['product'] ?></u></h2>
                <br>
                <?php echo $row["Description"] ?>
            </div>
            <hr class=" dropdown-divider">
            <center>
                <div class="row text-center justify-content-center">
                    <form action="edit.php" class=" col-2" method="POST">
                        <button type="submit" class="btn btn-primary" value="<?php echo $row['pid'] ?>" name="pid">
                            Edit Details
                        </button>
                    </form>
                    <form action="remove.php" class="col-2" method="POST">
                        <button type="submit" class="btn btn-danger" value="<?php echo $row['pid'] ?>" name="pid">
                            Remove Product
                        </button>
                    </form>
                </div>

            </center>
        </main>
<?php    }
} else {
    echo location("../dashboard/");
}
require("../extra/footer.php");
?>