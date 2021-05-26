<?php

use Codesses\php\Models\{RH, FP, User, Session, LoginHistory, DatabaseTwo};

require_once "./php/Models/Session.php";
require_once "./php/Models/User.php";
require_once "./php/Models/loginHistory.php";
require_once "./php/Models/DatabaseTwo.php";

// Get the session object.
$session = Session::getInstance();

// Get the action from the routing into.
$action = RH::getValue( RH::$action );
if( $action == RH::$actionLogOut ) {
  $session->destroy();
}

// If the user is already logged in, load the account page.
if( $session->hasUser() ) {
  header( "Location: passwords.php" );
  exit;
}


// Create a helper object.
$userDbHelper = new User;

// Set up the error messages array for use later in the html.
$errorMessages = array();
foreach( User::$loginNames as $input ) {
  $errorMessages[$input] = "";
}

// $params are used in the html below.
$params = User::getParams( User::$loginNames );

// See if this is a GET or POST request.
$isPost = FP::isPost( $userDbHelper->getSubmitName() );

if( $isPost ) {

  // Use the FP to retrieve the values from the form.
  $params = FP::getValuesObject( User::$loginNames );

  // See if we can find the user name.
  $users = $userDbHelper->getUsersWhere( "user_name", $params->user_name );
  if( $users == null || sizeof( $users) == 0 ) {
    $errorMessages[ "user_name" ] = User::$loginErrorMessages[ "user_name" ];

  } else {
    // There should be only one.
    $user = $users[0];

    // Check the password.
    if( !password_verify( $params->login_password, $user->login_password ) ) {

      // Indicate that the password doesn't match.
      $errorMessages[ "login_password" ] = User::$loginErrorMessages[ "login_password" ];

    } else {

      // Password match, do login and head to account page.
      $session->startSession( $user->user_id);

      // Add to Login History Table - Elle

      //Create new database connection
      $dbconnection = DatabaseTwo::getDb();
      //Instantiate a new class
      $s = new LoginHistory($dbconnection);
      //Function Call to Database
      $loginHistoryAdd = $s->addLoginHistory($_SESSION['user_id'], 'login');
      // - End of Elle

      if( $session->getUserId() == $user->user_id ) {
        header( "Location: listPasswords.php?" );
        exit;
      }
    }
  }
}

?>


<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Log In</title>
    <link rel="stylesheet" href="./css/login.css">
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv">
        <div class="content">
          <div>
            <h2>Log In</h2>
            <div class="formDiv">
              <form action="" method="POST">
              <div id="user_nameError" class="errorDiv"><?= $errorMessages["user_name"]; ?></div>
              <div class="inputDiv">
                <label for="user_name">User name</label>
                <input type="text" name="user_name" id="user_name" value="<?= $params->user_name; ?>"/>
                <span class="showHideSpan"></span>
              </div>

                <div id="login_passwordError" class="errorDiv"><?= $errorMessages["login_password"]; ?></div>
                <div class="inputDiv">
                  <label for="login_password">Password</label>
                  <input type="password" name="login_password" id="login_password" value="<?= $params->login_password; ?>" />
                  <span class="showHideSpan">Show</span>
                </div>

                <div class="inputDiv">
                <input type="submit"  name="<?= $userDbHelper->getSubmitName(); ?>" value="Log In">
                </div>  
              </form>
            </div>
            <div>
              <p>Not a user yet? <a href="<?php echo 'account.php?a=a1'; ?>">Create an account here.</a></p>
            </div>
          </div>
          <div>
            <a href="recoveryInformationMain.php">Forgot your password?</a>
          </div>
        </div>
      </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php"?>
  </body>
</html>
  
