<?php

use Codesses\php\Models\{DatabaseTwo, Password};

require "./php/Models/Crudpassword.php";
require "./php/Models/DatabaseTwo.php";

$question = $answer = "";

if (isset($_POST['updatebutton'])) {
  $id = $_POST['url_id'];
  $db = DatabaseTwo::getDb();

  $p = new Password();
  $password = $p->getPasswordbyId($id, $db);

  $user_name =  $password->user_name;
  $url = $password->url;
  $password = $password->password;
}
if (isset($_POST['updpassword'])) {
  $user_name = $_POST['user_name'];
  $url = $_POST['url'];
  $password = $_POST['password'];
  $id = $_POST['url_id'];

  $db = DatabaseTwo::getDb();
  $p = new Password();
  $count = $p->updatepassword($id, $user_name, $url, $password, $db);

  if ($count) {
    header('Location:  listPasswords.php');
    exit;
  } else {
    echo "problem";
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php include "php/head.php" ?>
  <title>Pass**** Manager password</title>
  <link rel="stylesheet" href="css/password.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="./js/script.js" async defer></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
  <main>
    <div class="mainDiv">
      <div class="content">
        <h2 class="hidden">Update Password</h2>
        <div id="passwordForm" class="formDiv2">
          <form name="addpasswordForm" action="" method="POST">
            <input type="hidden" name="url_id" value="<?= $id; ?>" />
            <div class="inputDiv">
              <label for="url">Url</label>
              <input type="text" name="url" id="url" value="<?= $url; ?>" />
            </div>
            <div class="inputDiv">
              <label for="user_name">Username</label>
              <input type="text" name="user_name" id="user_name" value="<?= $user_name; ?>" />
            </div>
            <div class="inputDiv">
              <label for="password">Password</label>
              <input type="text" name="password" id="password" value="<?= $password; ?>" />
            </div>
            <div class="inputDiv">
              <input type="submit" name="updpassword" value="Submit" />
            </div>
            <a href="./listPasswords.php" class="backLink">Back to Passwords</a>
          </form>
        </div>
      </div>
    </div>
  </main>
  <!--global footer-->
  <?php include "php/footer.php" ?>
</body>

</html>