<?php
// File created by Barbara Cam 2021/03.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Subscriber};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Subscriber.php';

$user = $frequency2 = "";
$s2 = new subscriber();
//get susbcription information by id
if(isset($_POST['updateSubscriber'])){
  $id= $_POST['subscriber_id'];
    
    $db = DatabaseTwo::getDb();
    $s = new subscriber();
    $subscriber = $s->getSubscriberById($id, $db);
      
    $user =  $subscriber->user;
    $frequency2 = $subscriber->frequency;
}

//post changes to the subscription and update the information
if(isset($_POST['updSubscriber'])){
    $id= $_POST['sid'];
    $user = $_POST['user'];
    $frequency = $_POST['frequency'];    

    $db = DatabaseTwo::getDb();    
    $s = new subscriber();
    $count = $s->updateSubscriber($id, $user, $frequency, $db);
      if($count){
        header('Location: subscribe.php');
        exit;
      } else {
        echo "Updating failing";
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
                <input type="hidden" name="sid" value="<?= $id ?>"/>
                <fieldset>
                  <legend>Do you want to join the mailing list?</legend>
                  <div class="inputDiv">
                    <label for="user" class="hidden">User_ID</label>
                    <input type="text" class="hidden" name="user" id="user" value="<?= $user; ?>" />
                  </div>
                  <div class="inputDiv">
                    <input type="radio" id="subscribew" name="frequency" value="weekly" <?= ($frequency2 == 'weekly') ? 'checked' : ''; ?> />
                    <label for="weekly">Weekly</label>
                    <input type="radio" id="subscribem" name="frequency" value="monthly" <?= ($frequency2 == 'monthly') ? 'checked' : ''; ?>/>
                    <label for="monthly">Monthly</label>
                    <input type="radio" id="subscribes" name="frequency" value="special" <?= ($frequency2 == 'special') ? 'checked' : ''; ?>/>
                    <label for="specials">Specials</label>                      
                  </div> 
                </fieldset>
                <div class="bt">
                  <a href="./subscribe.php" id="btn_back" class="backLink">Back</a>
                  <button type="submit" name="updSubscriber" id="btn-submit" class="backLink">Update</button>
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