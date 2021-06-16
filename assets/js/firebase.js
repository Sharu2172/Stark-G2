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

function setCookie(name, value = "", days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + value + ";" + expires + "; path=/";
}

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

function deleteCookie(name) {
  document.cookie = name + "=; path=/; expires=" + new Date(0).toUTCString();
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
      console.log(userCred);
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
      console.log(error);
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
        error: function (xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
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
}
