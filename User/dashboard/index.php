<?php include("../extra/header.php");
Access();
?>
<main class="col-md-auto ms-sm-auto col-lg-auto px-md-4">
    <center>
        <h2>Avilable Products</h2>
    </center>
    <form action="../search/index.php" method='GET'>
        <div class="row">
            <?php
            // This query is used for reading student data from database.
            $query = "SELECT * FROM `brands` ORDER BY 'product' ASC;";
            $query_run = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <div class="col-sm-3">
                    <div class="card">
                        <img src="../W3.jpg" class="card-img-top" alt="...">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Product : <?php echo $row['product']; ?></li>
                            <li class="list-group-item">Brand : <?php echo $row['brand']; ?></li>
                            <li class="list-group-item">Description : <?php echo $row["Description"]; ?></li>
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
require("../extra/footer.php");
?>