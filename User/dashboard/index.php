<?php
include("../extra/header.php");

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
                        </ul>
                        <?php if ($row['no'] > 0) { ?>
                            <button name="search" id="search" type="submit" class="btn btn-primary" value="<?php echo $row['pid']; ?>"> Details</button>
                        <?php } else { ?><button type="button" class="btn btn-secondary justify-content-center" disabled>
                                Out of Stock
                            </button>
                        <?php } ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </form>
</main>

<?php
require("../extra/footer.php");
?>