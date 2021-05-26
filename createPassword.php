<?php

use Codesses\php\Models\{Session};

require_once "./php/Models/Session.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if (!$session->hasUser()) {
  header("Location: login.php");
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Password};

require "./php/Models/CrudPassword.php";
require "./php/Models/DatabaseTwo.php";

$p = new Password();

if (isset($_POST['addPassword'])) {

  $user_id = $session->getUserId();
  $user_name = $_POST['user_name'];
  $url = $_POST['url'];
  $password = $_POST['password'];

  $db = DatabaseTwo::getDb();
  $s = new Password();
  $p = $s->addPassword($user_id, $user_name, $url, $password, $db);

  if ($p) {
    header("Location:listPasswords.php");
    exit;
  } else {
    echo "Problem adding Password";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php //include "php/head.php" 
  ?>
  <title>Pass**** Manager</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/passwords.css">
  <script src="./js/script.js" async defer></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <div class="content">
        <h2 class="hidden">Add Password</h2>
        <div id="passwordForm" class="formDiv2">
          <form name="addPasswordForm" action="" method="POST">
            <div class="inputDiv">
              <label for="user" class="hidden">User_ID</label>
              <input type="text" name="user" id="user" class="hidden" value="<?= $_SESSION['user_id'] ?>" />
            </div>
            <div class="inputDiv">
              <label for="url">URL</label>
              <input type="text" name="url" id="url" value="" />
            </div>
            <div class="inputDiv">
              <label for="user_name">Username</label>
              <input type="text" name="user_name" id="user_name" value="" />
            </div>
            <div class="inputDiv">
              <label for="password">Password</label>
              <input type="text" name="password" id="password" value="" />
            </div>
            <div class="inputDiv">
              <input type="submit" name="addPassword" value="Submit" />
            </div>
            <div id="backtoPasswords">
              <a href="./listPasswords.php" class="backLink">Back to FAQ</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>