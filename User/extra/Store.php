<?php
include("../../config.php");
if ($_POST['function'] == 'store') {
    if (isset($_POST['uid'])) {
        $_SESSION['uid'] = $_POST['uid'];
        $result = $conn->query("SELECT uid , uname , image, email FROM user WHERE uid = '" . $_SESSION["uid"] . "'");
        $row = mysqli_fetch_row($result);
        if (empty($row[0])) {
            $name = time();
            $_SESSION['name'] = $name;
            $_SESSION['image'] = "";
            $qry = "INSERT INTO user VALUES ('$_POST[uid]',$name,CURRENT_DATE,'Male','','$_POST[email]','','',CURRENT_TIMESTAMP)";
            if (mysqli_query($conn, $qry)) {
                echo "profile";
            } else {
                echo "failed";
            }
        } else {
            if ($_POST['email'] == $row[3]) {
                $conn->query("UPDATE user SET login_time = CURRENT_TIMESTAMP WHERE uid = '" . $_SESSION["uid"] . "'");
            } else {
                $conn->query("UPDATE user SET login_time = CURRENT_TIMESTAMP , email = '$_POST[email]' WHERE uid = '" . $_SESSION["uid"] . "'");
            }
            $_SESSION['name'] = $row[1];
            $_SESSION['image'] = $row[2];
            echo "sucess";
        }
    }
} else if ($_POST['function'] == 'delete') {
    unset($_SESSION['uid']);
    unset($_SESSION['name']);
    unset($_SESSION['image']);
    if (isset($_SESSION['uid'])) {
        echo "failed";
    } else {
        echo "sucess";
    }
} else {
    echo location("../../");
}
