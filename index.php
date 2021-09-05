<?php include("Session.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!-- Our Custom CSS -->

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
            <img class="mb-4" src="assets/image/inventory-96.png" alt="" width="72" height="57">
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
                if (user.email === "dsharath217@gmail.com") {
                    $.ajax({
                        url: "Admin/extra/Store.php",
                        type: "post",
                        data: {
                            function: "store",
                            auid: user.uid,
                            aemail: user.email,
                            aname: user.displayName
                        },
                        success: function(status) {
                            document.location.href = "Admin/dashboard/";
                        },
                        error: function(xhr, desc, err) {
                            showMessage("Login Error", "Cannot Login Now.Please Try Again Later...");
                            console.log(xhr);
                            console.log("Details: " + desc + "\nError:" + err);
                        },
                    });
                } else {
                    if (user.emailVerified == false) {
                        firebase.auth().currentUser.sendEmailVerification().then(function() {
                            // Email Verification sent!
                            showMessage("Email Not Verified", "Verification Email Sent.Please Verify your Email.");
                        });
                        firebase.auth().signOut();
                    } else {
                        $.ajax({
                            url: "User/extra/Store.php",
                            type: "post",
                            data: {
                                function: "store",
                                uid: user.uid,
                                email: user.email,
                                name: user.displayName
                            },
                            success: function(status) {
                                if (status === "profile") {
                                    document.location.href = "User/profile/";
                                } else {
                                    document.location.href = "User/dashboard/";
                                }
                            },
                            error: function(xhr, desc, err) {
                                showMessage("Login Error", "Cannot Login Now.Please Try Again Later...");
                                console.log(xhr);
                                console.log("Details: " + desc + "\nError:" + err);
                            },
                        });
                    }
                }

            }
        });
    </script>

</body>

</html>