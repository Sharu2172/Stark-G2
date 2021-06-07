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
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin">
        <form>
            <img class="mb-4" src="assets/image/icons8-in-inventory-96.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                                        echo $_COOKIE["email"];
                                                                                                                    } ?>">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?php if (isset($_COOKIE["password"])) {
                                                                                                                    echo $_COOKIE["password"];
                                                                                                                } ?>">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" id="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" id="sign-in">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
        </form>
    </main>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/firebase_EP.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-auth.js"></script>
    <script type="text/javascript">
        document
            .getElementById("quickstart-password-reset")
            .addEventListener("click", sendPasswordReset, false);
    </script>
</body>

</html>