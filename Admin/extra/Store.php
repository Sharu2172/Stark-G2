<?php
include("../../config.php");
if ($_POST['function'] == 'store') {
    if (isset($_POST['auid'])) {
        $_SESSION['auid'] = $_POST['auid'];
        $_SESSION['aname'] = $_POST['aname'];
        $_SESSION['aimage'] = $_POST['aimage'];
        echo "sucess";
    }
} else if ($_POST['function'] == 'delete') {
    unset($_SESSION['auid']);
    unset($_SESSION['aname']);
    unset($_SESSION['aimage']);
    if (isset($_SESSION['auid'])) {
        echo "failed";
    } else {
        echo "sucess";
    }
} else {
    echo location("../../");
}
