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
function toggleSignIn() {
  if (firebase.auth().currentUser) {
    firebase.auth().signOut();
  } else {
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
      .catch(function (error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        if (errorCode === "auth/wrong-password") {
          alert("Wrong password.");
        } else {
          alert(errorMessage);
        }
        console.log(error);
        document.getElementById("quickstart-sign-in").disabled = false;
      });
  }
  document.getElementById("quickstart-sign-in").disabled = true;
}

/**
 * Sends an email verification to the user.
 */
function sendEmailVerification() {
  firebase
    .auth()
    .currentUser.sendEmailVerification()
    .then(function () {
      // Email Verification sent!
      alert("Email Verification Sent!");
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
      console.log(error);
    });
}

function update() {
  var user = firebase.auth().currentUser;
  user
    .updateProfile({
      displayName: "Sharath",
    })
    .then(function () {
      // Update successful.
      console.log("User Profile Updated Successfully");
    })
    .catch(function (error) {
      alert(error);
    });
}

/**
 * initApp handles setting up UI event listeners and registering Firebase auth listeners:
 *  - firebase.auth().onAuthStateChanged: This listener is called when the user is signed in or
 *    out, and that is where we update the UI.
 */
function initApp() {
  // Listening for auth state changes.
  firebase.auth().onAuthStateChanged(function (user) {
    document.getElementById("quickstart-verify-email").disabled = true;
    if (user) {
      // User is signed in.
      var displayName = user.displayName;
      console.log(displayName);
      var email = user.email;
      var emailVerified = user.emailVerified;
      var photoURL = user.photoURL;
      var isAnonymous = user.isAnonymous;
      var uid = user.uid;
      var providerData = user.providerData;
      document.getElementById("quickstart-sign-in-status").textContent =
        "Signed in";
      document.getElementById("quickstart-sign-in").textContent = "Sign out";
      document.getElementById("quickstart-account-details").textContent =
        JSON.stringify(user, null, "  ");
      if (!emailVerified) {
        document.getElementById("quickstart-verify-email").disabled = false;
      }
    } else {
      // User is signed out.
      document.getElementById("quickstart-sign-in-status").textContent =
        "Signed out";
      document.getElementById("quickstart-sign-in").textContent = "Sign in";
      document.getElementById("quickstart-account-details").textContent =
        "null";
    }
    document.getElementById("quickstart-sign-in").disabled = false;
  });

  document
    .getElementById("quickstart-sign-in")
    .addEventListener("click", toggleSignIn, false);
  document
    .getElementById("quickstart-verify-email")
    .addEventListener("click", sendEmailVerification, false);
  document
    .getElementById("quickstart-password-reset")
    .addEventListener("click", sendPasswordReset, false);
}
