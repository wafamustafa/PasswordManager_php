<?php

// File created by Barbara Cam 2021/03.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Subscriber};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Subscriber.php';

$s = new Subscriber(); 
$frequency = '';

//add subscription information to the database
if(isset($_POST['addSubscriber'])){
    $user = $_POST['user'];
    $frequency = $_POST['frequency'] ?? '';
    
    if($frequency == ''){
      $radionov = "Please fill radio button";
    } else {
      $db = DatabaseTwo::getDb();
      $s = new Subscriber();       
      $b = $s->addSubscriber($user, $frequency, $db);

      if($b){
        header("Location: subscribe.php");
        exit;

      } else {
        echo "problem adding a subscriber";
      }
    }
    
}

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Home</title>
    <link rel="stylesheet" href="./css/subscribe.css">
    <script src="./js/script.js" async defer></script>
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv"> 
      <!--side nav-->
      <?php include 'php/sideNav.php' ?>   
        <!-- YOUR STUFF GOES HERE-->
        <div class="content">
          <div>
            <h2>Subscribe</h2>
            <h2 class="hidden">Subscribe</h2>
            <div class="formDiv">
              
              <form action="" method="POST">
                <fieldset>
                  <legend>Do you want to join the mailing list?</legend>
                   <div class="inputDiv">
                      <label for="user" class="hidden">User_ID</label>
                      <input type="text" name="user" id="user" class="hidden" value="<?= $_SESSION['user_id'] ?>" />
                    </div>
                    <div class="inputDiv">
                      <input type="radio" id="subscribew" name="frequency" value="weekly" <?= ($frequency == 'weekly') ? 'checked' : ''; ?> />
                      <label for="weekly">Weekly</label>
                      <input type="radio" id="subscribem" name="frequency" value="monthly" <?= ($frequency == 'monthly') ? 'checked' : ''; ?> />
                      <label for="monthly">Monthly</label>
                      <input type="radio" id="subscribes" name="frequency" value="special" <?= ($frequency == 'special') ? 'checked' : ''; ?> />
                      <label for="specials">Specials</label>
                      <span style="..."><?= isset($radionov) ? $radionov : ''; ?></span>
                    </div> 
                </fieldset>
                <div class='bt'>
                  <a href="./subscribe.php" id="btn_back" class="backLink">Back</a>
                  <button type="submit" name="addSubscriber" id="btn-submit" class="backLink">Subscribe</button>
                </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php"?>
  </body>
</html>