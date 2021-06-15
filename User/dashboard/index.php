<?php
include("../extra/header.php");
$result = $conn->query("SELECT COUNT(1) FROM user WHERE uid = '" . $_COOKIE["uid"] . "'");
$row = mysqli_fetch_row($result);
if ($row[0] < 1) {
    $name = time();
    $qry = "INSERT INTO user VALUES ('$_COOKIE[uid]',$name,CURRENT_DATE,'Male','','$_COOKIE[email]','','')";
    if (mysqli_query($conn, $qry)) {
        echo location("../profile/index.php");
    }
}
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
require("../extra/footer.php");
?>