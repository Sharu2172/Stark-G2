<?php
include("../config.php");
include("../Session.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta ty>
    <title>Stock Management System</title>
    <link rel="manifest" href="../manifest.json">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="SMS">
    <meta name="apple-mobile-web-app-title" content="SMS">
    <meta name="msapplication-starturl" content="/index.html">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" sizes="96px" href="../assets/image/icons8-in-inventory-96.png">
    <link rel="apple-touch-icon" type="image/png" sizes="96px" href="../assets/image/icons8-in-inventory-96.png">

    <!-- Material Design Theming -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.orange-indigo.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    <link rel="stylesheet" href="../assets/css/main.css" />

    <!-- Import and configure the Firebase SDK -->
    <!-- These scripts are made available when the app is served or deployed on Firebase Hosting -->
    <!-- If you do not serve/host your project using Firebase Hosting see https://firebase.google.com/docs/web/setup -->
</head>

<body>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-auth.js"></script>
    <script type="text/javascript" src="../assets/js/firebase_EP.js"></script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>