<?php
include('../../config.php');
Access();
if (isset($_POST['iid'])) {
    $uid = $_SESSION["uid"];
    $iid = $_POST['iid'];
    unset($_POST);
    $qry = "SELECT T.id AS invoice, T.uname, U.email, U.address, date(T.timestamp) as date, T.total, T.quantity, S.cost, T.pname FROM transaction T INNER JOIN user U ON U.uid=T.uid INNER JOIN stocks S ON S.pid=T.pid WHERE T.id='$iid'";
    $query_run = mysqli_query($conn, $qry);
    if ($row = mysqli_fetch_assoc($query_run)) { ?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
        <div id="invoice">
            <header>
                <h1>Invoice</h1>
            </header>
            <article>
                <address>
                    <p>Murgesh Distributions</p>
                </address>
                <table>
                    <tr>
                        <th><span>Invoice #</span></th>
                        <td><span><?php echo $row['invoice']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Buyer Name : </span></th>
                        <td><span><?php echo $row['uname']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Email</span></th>
                        <td><span><?php echo $row['email']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Delivery Address : </span></th>
                        <td><span><?php echo $row['address']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Date</span></th>
                        <td><span><?php echo $row['date']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Amount Due</span></th>
                        <td><span id="prefix"> &#x20b9;</span><span><?php echo $row['total']; ?></span></td>
                    </tr>
                </table>
                <br>
                <table class="inventory">
                    <thead>
                        <tr>
                            <th><span>Item</span></th>
                            <th><span>Rate</span></th>
                            <th><span>Quantity</span></th>
                            <th><span>Price</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span><?php echo $row['pname']; ?></span></td>
                            <td><span data-prefix> &#x20b9; </span><span><?php echo $row['cost']; ?></span></td>
                            <td><span><?php echo $row['quantity']; ?></span></td>
                            <td><span data-prefix> &#x20b9; </span><span><?php echo $row['total']; ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <table class="balance">
                    <tr>
                        <th><span>Total</span></th>
                        <td><span data-prefix> &#x20b9; </span><span><?php echo $row['total']; ?></span></td>
                    </tr>
                    <tr>
                        <th><span>Amount Paid</span></th>
                        <td><span data-prefix> &#x20b9; </span><span>0</span></td>
                    </tr>
                    <tr>
                        <th><span>Balance Due</span></th>
                        <td><span data-prefix> &#x20b9; </span><span><?php echo $row['total']; ?></span></td>
                    </tr>
                </table>
            </article>
        </div>
        <div class="row justify-content-center">
            <dic class="col-3"> <button class="btn btn-primary" id="print">Print</button> </dic>
            <dic class="col-3"> <button class="btn btn-secondary" id="close">Back</button> </dic>
        </div>
<?php } else {
        echo location("../dashboard/index.php");
    }
} else {
    echo location("../dashboard/index.php");
}
?>
<script>
    document.getElementById('print').addEventListener('click', function() {
        const element = document.getElementById("invoice");
        var opt = {
            margin: 1,
            filename: 'Invoice.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        // Old monolithic-style usage:
        html2pdf(element, opt);
    }, false);
    document.getElementById('close').addEventListener('click', function() {
        document.location.href = "../Transaction/";
    }, false)
</script>