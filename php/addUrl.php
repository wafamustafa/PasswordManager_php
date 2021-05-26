<?php

use Codesses\php\Models\{FormProcessor, Url};

require_once "./Models/Url.php";
require_once "./Models/FormProcessor.php";

$urlDbHelper = new Url;

// $errorMessages = array();
// foreach( Url::$inputNames as $input ) {
//   $errorMessages[$input] = "";
// }

// $params = Url::getParams( Url::$inputNames );

// Use the FormProcessor to check if the form has been submitted.
// The name of the submit button in the form (see the html below)
// was set using $urlDbHelper->getSubmitAdd(), so we know it will
// be the same and we don't have to worry about typos.
if( FormProcessor::isPost( $urlDbHelper->getSubmitAdd() ) ) {

  // Use the FormProcessor to retrieve the values from the form.
  $params = FormProcessor::getValuesObject( Url::$inputNames );
  // Database::prettyPrintObj( $params );

  // Validate the input. This will reflect what the js validate does,
  // but we can do a bit more because we have access to the database.
//   $result = $urlDbHelper->validateInput( $params, "create" );

//   if( $result != null ) {

//     // Setting the error message here will cause it to show up in the html.
//     // See the divs with class="errorDiv" below.
//     $errorMessages[$result] = Url::$errorMessages[$result];
  
//   } else {
    // Sometimes we don't get useful return values from the database.
    // The best way to check that a new user has been added is to check
    // that the number of users after adding the user has increased.
    // *NOTE: in a large system this won't work because someone might
    // delete a user after you get the number of users before adding
    // yours. But it will do for now.

    // Adjust the params for the database.
    // $params = $urlDbHelper->fixParams( $params, "create" );
    // Database::prettyPrintObj( $params );
  
    // Get the current number of users.
    $numUrls = $urlDbHelper->getNumUrls();

    // Add the new user.
    $urlDbHelper->createUrl( $params );

    // Make sure that the number of users has changed.
    if( $numUrls != $urlDbHelper->getNumUrls() ) {
      // Success! 
      // TODO: go to account page.
      header("Location: passwords.php");
      exit;

    } else {
      // Failed.
      // TODO: go to error message.
      echo "Unable to add password.";
    }
//   }
}
?>


<html>
  <head>

    <?php include "head.php" ?>

    <title>Pass**** Manager Add Password</title>
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>

<?php include 'header.php' ?>

<main>
      <div class="mainDiv">
        <div class="content">
          <h2 class="hidden">Create Account</h2>
          <div id="newPasswordFormDiv" class="formDiv">
            <form name="newPasswordForm" action="" method="POST">

              <div id="urlError" class="errorDiv"></div>
              <div class="inputDiv">
                <label for="url">First name</label>
                <input type="text" name="url" id="url" />
                <span class="showHideSpan"></span>
              </div>

              <div id="user_nameError" class="errorDiv"></div>
              <div class="inputDiv">
                <label for="user_name">Create a user name</label>
                <input type="text" name="user_name" id="user_name" />
                <span class="showHideSpan"></span>
              </div>
 
              <div id="passwordError" class="errorDiv"></div>
              <div class="inputDiv">
                <label for="password">Password</label>
                <input type="text" name="password" id="password" />
                <span class="showHideSpan">Show</span>
              </div>

              <div id="password_hintError" class="errorDiv"></div>
              <div class="inputDiv">
                <label for="password_hint">Repeat password</label>
                <input type="text" name="password_hint" id="password_hint" />
                <span class="showHideSpan">Show</span>
              </div>

              <div class="inputDiv">
                <input type="submit"  name="<?php echo $userObject->getSubmitAdd(); ?>" value="Sign Up">
              </div>  
            </form>
          </div>
      </div>
      </div>
    </main>

<?php include "footer.php" ?>

  </body>
</html>
