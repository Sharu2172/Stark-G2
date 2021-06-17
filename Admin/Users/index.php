<?php include("../extra/header.php"); ?>
<div class="float-right row g-3">
    <table class="table table-responsive text-center table-hover w-100">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">D.O.B.</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
                <th scope="col">Last Login</th>
            </tr>
        </thead>
        <tbody>
            <form action="single.php" method="POST">
                <?php
                // This query is used for reading student data from database.
                $query = "SELECT * FROM user WHERE 1";
                $query_run = mysqli_query($conn, $query);
                $count = 1;
                while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                    <tr>
                        <th scope="row"> <?php echo $count;
                                            $count++; ?> </th>
                        <td> <button type="submit" value="<?php echo $row['uid'] ?>" class=" bg-transparent border-0" name="uid"><?php echo $row['uname']; ?></button></td>
                        <td> <?php echo $row['dob']; ?> </td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row["ph_no"]; ?> </td>
                        <td> <?php echo $row['address']; ?> </td>
                        <td> <?php echo $row["login_time"]; ?> </td>
                    </tr>

                <?php } ?>
            </form>
        </tbody>
    </table>
</div>
<?php include("../extra/footer.php"); ?>