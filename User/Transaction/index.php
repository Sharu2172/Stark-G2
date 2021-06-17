<?php include('../extra/header.php') ?>
<div class="row g-3 p-2">
    <div class="col-md-3">
        <select class="form-select" id="dmy">
            <option selected value="date">Date</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
        </select>
    </div>
    <div class="col-md-3" id="data">
        <form method="POST" action="" id="dmyform">
            <input type="date" class="form-control" id="date" name="date">
        </form>
    </div>
    <div class="col-md-3">
        <button id="submit" class=" btn btn-primary form-control">
            Submit
        </button>
    </div>
</div>
<div class="float-right row g-3">
    <table class="table table-responsive text-center table-hover w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Product</th>
                <th scope="col">Brand</th>
                <th scope="col">Quantity</th>
                <th scope="col">Cost</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Invoice</th>
            </tr>
        </thead>
        <tbody>
            <form action="../bill/index.php" method="POST">
                <?php
                // This query is used for reading student data from database.
                if (isset($_POST["date"])) {
                    $query = "SELECT T.id,T.uid , S.product , S.cost , T.total , T.quantity , S.brand , date(T.timestamp) as date FROM transaction T , stocks S WHERE T.pid=S.pid AND T.uid = '$_SESSION[uid]' AND date(timestamp) = '$_POST[date]'";
                } else if (isset($_POST["month"])) {
                    $month = substr($_POST["month"], 5, 6);
                    $year = substr($_POST["month"], 0, 4);
                    $query = "SELECT T.id,T.uid , S.product , S.cost , T.total , T.quantity , S.brand , date(T.timestamp) as date FROM transaction T , stocks S WHERE T.pid=S.pid AND T.uid = '$_SESSION[uid]' AND month(timestamp) = '$month' AND year(timestamp) = '$year'";
                } else if (isset($_POST["year"])) {
                    $query = "SELECT T.id,T.uid , S.product , S.cost , T.total , T.quantity , S.brand , date(T.timestamp) as date FROM transaction T , stocks S WHERE T.pid=S.pid AND T.uid = '$_SESSION[uid]' AND year(timestamp) = '$_POST[year]'";
                } else {
                    $query = "SELECT T.id,T.uid , S.product , S.cost , T.total , T.quantity , S.brand , date(T.timestamp) as date FROM transaction T , stocks S WHERE T.pid=S.pid AND T.uid = '$_SESSION[uid]'";
                }
                $query_run = mysqli_query($conn, $query);
                $count = 1;
                while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                    <tr>
                        <th scope="row"> <?php echo $count;
                                            $count++; ?> </th>
                        <td> <?php echo $row['product']; ?> </td>
                        <td> <?php echo $row['brand']; ?> </td>
                        <td> <?php echo $row["quantity"]; ?> </td>
                        <td> <?php echo $row['cost']; ?> </td>
                        <td> <?php echo $row['total']; ?> </td>
                        <td> <?php echo $row["date"]; ?> </td>
                        <td> <button type="submit" class="bg-transparent border-0" name="iid" value="<?php echo $row['id']; ?>">Generate</button> </td>
                    </tr>

                <?php } ?>
            </form>
        </tbody>
    </table>
    <script>
        $("#dmy").change(function() {
            console.log(this.value);
            if (this.value === "date") {
                document.getElementById("date").setAttribute("name", "date");
                document.getElementById("date").setAttribute("type", "date");
            } else if (this.value === "month") {
                document.getElementById("date").setAttribute("name", "month");
                document.getElementById("date").setAttribute("type", "month");
            } else if (this.value === "year") {
                document.getElementById("date").setAttribute("name", "year");
                document.getElementById("date").setAttribute("type", "number");
            }
        });
        document.getElementById("submit").addEventListener("click", function() {
            document.getElementById("dmyform").submit();
        }, false);
    </script>
    <?php include('../extra/footer.php') ?>