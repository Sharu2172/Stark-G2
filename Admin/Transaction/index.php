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
<div class="float-right row g-3 table-responsive">
    <table class="table text-center table-hover w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Product</th>
                <th scope="col">Brand</th>
                <th scope="col">Quantity</th>
                <th scope="col">Cost</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // This query is used for reading student data from database.
            if (isset($_POST["date"])) {
                $query = "SELECT *,date(timestamp) as date FROM transaction T WHERE date(timestamp) = '$_POST[date]'";
                unset($_POST["date"]);
            } else if (isset($_POST["month"])) {
                $month = substr($_POST["month"], 5, 6);
                $year = substr($_POST["month"], 0, 4);
                $query = "SELECT *,date(timestamp) as date FROM transaction T WHERE month(timestamp) = '$month' AND year(timestamp) = '$year'";
                unset($_POST["month"]);
            } else if (isset($_POST["year"])) {
                $query = "SELECT *,date(timestamp) as date FROM transaction T WHERE year(timestamp) = '$_POST[year]'";
                unset($_POST["year"]);
            } else {
                $query = "SELECT *,date(timestamp) as date FROM transaction T";
            }
            $query_run = mysqli_query($conn, $query);
            $total = 0;
            while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                <tr>
                    <th scope="row"> <?php echo $row['id']; ?> </th>
                    <td> <?php echo $row['uname']; ?> </td>
                    <td> <?php echo $row['pname']; ?> </td>
                    <td> <?php echo $row['brand']; ?> </td>
                    <td> <?php echo $row["quantity"]; ?> </td>
                    <td> <?php echo $row['cost']; ?> </td>
                    <td> <?php echo $row['total'];
                            $total += $row['total']; ?> </td>
                    <td> <?php echo $row["date"]; ?> </td>
                </tr>

            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Spent : </td>
                <td colspan="2"><?php echo $total ?></td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    $("#dmy").change(function() {
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