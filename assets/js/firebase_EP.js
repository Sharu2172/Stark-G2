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

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function SignIn() {
  event.preventDefault();
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  console.log(email, password);
  if (email.length < 4) {
    alert("Please enter an email address.");
    console.log("Please enter a new password.");
    return;
  }
  if (password.length < 4) {
    alert("Please enter a new password.");
    console.log("Please enter a new password.");
    return;
  }
  // Sign in with email and pass.
  firebase
    .auth()
    .signInWithEmailAndPassword(email, password)
    .then(function (userCred) {
      var user = userCred.user;
      var displayName = user.displayName;
      var email = user.email;
      var uid = user.uid;
      var rem = document.getElementById("remember-me");
      document.cookie = `uid = ${uid};`;
      document.cookie = `name = ${displayName};`;
      if (rem.checked && email.value !== "") {
        console.log("Run Sucessful");
        localStorage.usermail = user.email;
        document.cookie = `email = ${email};`;
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
      console.log(error);
    });
}

function SignOut() {
  firebase
    .auth()
    .signOut()
    .then(() => {
      console.log("Signout");
      document.cookie = `uid = ;`;
      document.cookie = `name = ;`;
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
      console.log(error);
    });
}

function showMessage(Title, Body) {
  document.getElementById(
    "Messages"
  ).innerHTML = `<button type="button" id="showMessage" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#message" hidden></button>
        <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="ModalBody">
                    </div>
                    <div class="modal-footer" id="ModalFooter">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>`;
  document.getElementById("ModalLabel").textContent = Title;
  document.getElementById("ModalBody").textContent = Body;
  document.getElementById("showMessage").click();
  console.log("Show Message");
}
