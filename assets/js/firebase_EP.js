var firebaseConfig = {
  apiKey: "AIzaSyA04jtRQQ7hTXyiJP3esowPxW7tW_7EAhA",
  authDomain: "imsp-g2.firebaseapp.com",
  projectId: "imsp-g2",
  storageBucket: "imsp-g2.appspot.com",
  messagingSenderId: "632613442760",
  appId: "1:632613442760:web:635e3a701df122967501fd",
  measurementId: "G-SDHKM6ZYWZ",
};

firebase.initializeApp(firebaseConfig);

function SignIn() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  if (email.length < 4) {
    alert("Please enter an email address.");
    return;
  }
  if (password.length < 4) {
    alert("Please enter a password.");
    return;
  }
  // Sign in with email and pass.
  firebase
    .auth()
    .signInWithEmailAndPassword(email, password)
    .then(function (userCred) {
      var user = userCred.user;
      var emailVerified = user.emailVerified;
      if (!emailVerified) {
        firebase
          .auth()
          .currentUser.sendEmailVerification()
          .then(function () {
            // Email Verification sent!
            alert("Verification Mail Sent. Please Verify It ...");
          });
      }
    })
    .catch(function (error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      if (errorCode === "auth/wrong-password") {
        alert("Wrong password.");
      } else {
        alert(errorMessage);
      }
    });
}

function sendPasswordReset() {
  var email = document.getElementById("email").value;
  firebase
    .auth()
    .sendPasswordResetEmail(email)
    .then(function () {
      // Password Reset Email Sent!
      alert("Password Reset Email Sent!");
    })
    .catch(function (error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      if (errorCode == "auth/invalid-email") {
        alert(errorMessage);
      } else if (errorCode == "auth/user-not-found") {
        alert(errorMessage);
      } else {
        alert(error);
      }
    });
}

function initApp() {
  // Listening for auth state changes.
  firebase.auth().onAuthStateChanged(function (user) {
    document.getElementById("quickstart-verify-email").disabled = true;
    if (user) {
      // User is signed in.
      document.cookie = `name=${user.displayName}`;
      document.cookie = `email=${user.email}`;
      var password = document.getElementById("password").value;
      document.cookie = `password=${password}`;
      document.cookie = `uid=${user.uid}`;
    } else {
      document.cookie = `name=`;
      document.cookie = `email=`;
      document.cookie = `password=`;
      document.cookie = `uid=`;
    }
  });

  document
    .getElementById("sign-in")
    .addEventListener("click", toggleSignIn, false);

  document
    .getElementById("password-reset")
    .addEventListener("click", sendPasswordReset, false);
}
