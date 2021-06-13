<?php include("Session.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Signin Template · Bootstrap v5.0</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/jquery/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">

    <link href="assets/css/login.css" rel="stylesheet">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="text-center">
    <main class="form-signin">
        <form>
            <img class="mb-4" src="assets/image/icons8-in-inventory-96.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password"> <label for=" password">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" id="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" id="sign-in">Sign in</button>
            <p class="mt-5 mb-3"><a data-bs-toggle="modal" data-bs-target="#resetModal">Forgot Password</a></p>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resetModalLabel">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="resetMail" placeholder="name@example.com" value="">
                            <label for="resetMail">Email address</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="sendMail" class="btn btn-primary" data-bs-dismiss="modal">Send Reset Mail</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="Messages"></div>
    </main>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-analytics.js">
    </script>
    <script src="assets/js/firebase.js"></script>
    <script type="text/javascript">
        document.getElementById("sign-in").addEventListener("click", SignIn, false);
        document
            .getElementById("sendMail")
            .addEventListener("click", sendPasswordReset, false);
        window.onload = function() {
            var rmCheck = document.getElementById("remember-me");
            var email = document.getElementById("email");
            var rmail = document.getElementById("resetMail");

            if (localStorage.checkbox && localStorage.checkbox !== "") {
                rmCheck.setAttribute("checked", "checked");
                email.setAttribute("value", localStorage.usermail);
                rmail.setAttribute("value", localStorage.usermail);
            } else {
                rmCheck.removeAttribute("checked");
                email.value = "";
                rmail.value = "";
            }
        }
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                document.location.href = "User/dashboard/";
            }
        });
    </script>

</body>

</html>