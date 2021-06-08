<?php session_start(); ?>
<!DOCTYPE html>
<html>

<body>

    <div id="result"></div>

    <script>
        // Check browser support
        if (typeof(Storage) !== "undefined") {
            // Store
            sessionStorage.setItem("lastname", "Smith");
            // Retrieve
            document.getElementById("result").innerHTML = sessionStorage.getItem("lastname");
        } else {
            document.getElementById("result").innerHTML = "Sorry, your browser does not support Web Storage...";
        }

        function backAway() {
            //if it was the first page
            if (history.length >= 1) {
                history.back();
            }
        }
    </script>

    <p>http://localhost/Github/Stark-G2/test.php</p>
    <a href="#" onClick="backAway()">Back</a>

</body>

</html>