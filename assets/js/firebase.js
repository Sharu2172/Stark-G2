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

function CreateUser() {
  var email = document.getElementById("cuemail").value;
  var password = email.split("@")[0];
  firebase
    .auth()
    .createUserWithEmailAndPassword(email, password)
    .then((userCredential) => {
      var user = userCredential.user;
      var message = "User has been created with email address : " + user.email;
      showMessage("Created User", message);
    })
    .catch((error) => {
      var errorCode = error.code;
      var errorMessage = error.message;
      showMessage(errorCode, errorMessage);
    });
}

function SignIn() {
  event.preventDefault();
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  if (email.length < 4) {
    alert("Please enter an email address.");
    return;
  }
  if (password.length < 4) {
    alert("Please enter a new password.");
    return;
  }
  // Sign in with email and pass.
  firebase
    .auth()
    .signInWithEmailAndPassword(email, password)
    .then(function (userCred) {
      var user = userCred.user;
      var rem = document.getElementById("remember-me");

      if (rem.checked && email.value !== "") {
        localStorage.usermail = user.email;
        localStorage.checkbox = rem.value;
      } else {
        localStorage.usermail = "";
        localStorage.checkbox = "";
      }
    })
    .catch(function (error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      var title = "Login Failed";
      if (errorCode == "wrong-password") {
        title = "Wrong Password";
      }
      showMessage(title, errorMessage);
    });
}

function updateMail() {
  const cemail = document.getElementById("changeemail").value;
  firebase.auth().onAuthStateChanged(function (user) {
    if (user) {
      user
        .updateEmail(cemail)
        .then(function () {
          showMessage(
            "Update Email Sucessful",
            "Your Email has been Updated Sucessfully."
          );
        })
        .catch(function (error) {
          console.log(error);
          showMessage(error.code, error.message);
        });
    } else {
      showMessage("Cannot Update Email", "Your Email cannot be Updated.");
    }
  });
}

function removeUser(email) {
  firebase.auth().onAuthStateChanged(function (user) {
    if (user) {
      if (user.email === email) {
        user
          .delete()
          .then(function () {
            showMessage(
              "Acount Delete Sucessful",
              "Your Account has been Deleted Sucessfully."
            );
            SignOut();
          })
          .catch(function (error) {
            showMessage(error.code, error.message);
          });
      } else {
        showMessage("Cannot Delete Account", "Log Out , Log In and Try Again.");
      }
    } else {
      showMessage("Cannot Delete Account", "Your Account cannot be Deleted.");
    }
  });
}
function SignOut() {
  firebase
    .auth()
    .signOut()
    .then(() => {
      $.ajax({
        url: "../extra/Store.php",
        type: "post",
        data: { function: "delete" },
        success: function (status) {
          if (status === "sucess") {
            document.location.href = "../../";
          }
        },
        error: function () {
          showMessage("Cannot Signout Now", "Please try again Later.");
        },
      }); // end ajax call
    });
}

function sendPasswordReset() {
  var email = document.getElementById("resetMail").value;
  firebase
    .auth()
    .sendPasswordResetEmail(email)
    .then(function () {
      // Password Reset Email Sent!
      showMessage(
        "Reset Mail",
        "Password Reset Mail Has Been Sent to Your Mail ID."
      );
    })
    .catch(function (error) {
      // Handle Errors here.
      var errorCode = error.code;
      var errorMessage = error.message;
      var title = "Reset Failed";
      if (errorCode == "auth/invalid-email") {
        title = "Invalid Email";
      } else if (errorCode == "auth/user-not-found") {
        title = "User Not Found";
      }
      showMessage(title, errorMessage);
    });
}
