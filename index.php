<?php require("header.php"); ?>
<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <!-- Header section containing title -->
  <header class="
          mdl-layout__header
          mdl-color-text--white
          mdl-color--light-blue-700
        ">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
      <div class="
              mdl-layout__header-row
              mdl-cell
              mdl-cell--12-col
              mdl-cell--12-col-tablet
              mdl-cell--8-col-desktop
            ">
        <h3>Firebase Authentication</h3>
      </div>
    </div>
  </header>

  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
      <!-- Container for the demo -->
      <div class="
              mdl-card
              mdl-shadow--2dp
              mdl-cell
              mdl-cell--12-col
              mdl-cell--12-col-tablet
              mdl-cell--12-col-desktop
            ">
        <div class="
                mdl-card__title
                mdl-color--light-blue-600
                mdl-color-text--white
              ">
          <h2 class="mdl-card__title-text">
            Firebase Email &amp; Password Authentication
          </h2>
        </div>
        <div class="mdl-card__supporting-text mdl-color-text--grey-600">
          <p>
            Enter an email and password below and either sign in to an
            existing account or sign up
          </p>

          <input class="mdl-textfield__input" style="display: inline; width: auto" type="text" id="email" name="email" placeholder="Email" />
          &nbsp;&nbsp;&nbsp;
          <input class="mdl-textfield__input" style="display: inline; width: auto" type="password" id="password" name="password" placeholder="Password" />
          <br /><br />
          <button disabled class="mdl-button mdl-js-button mdl-button--raised" id="quickstart-sign-in" name="signin">
            Sign In
          </button>
          &nbsp;&nbsp;&nbsp;

          <button class="mdl-button mdl-js-button mdl-button--raised" disabled id="quickstart-verify-email" name="verify-email">
            Send Email Verification
          </button>
          &nbsp;&nbsp;&nbsp;
          <button class="mdl-button mdl-js-button mdl-button--raised" id="quickstart-password-reset" name="verify-email">
            Send Password Reset Email
          </button>

          <!-- Container where we'll display the user details -->
          <div class="quickstart-user-details-container">
            Firebase sign-in status:
            <span id="quickstart-sign-in-status">Unknown</span>
            <div>Firebase auth <code>currentUser</code> object value:</div>
            <pre><code id="quickstart-account-details">null</code></pre>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script type="text/javascript">
  window.onload = function() {
    initApp();
  };
</script>
<?php require("footer.php"); ?>