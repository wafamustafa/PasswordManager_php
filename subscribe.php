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

//list of all subscription filter by user
$dbconnection = DatabaseTwo::getDb();
$s = new subscriber();
$user_id = $session->getUserId();
$subscribers = $s->getAllSubscribers($user_id, DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Home</title>
    <link rel="stylesheet" href="css/subscribe.css">
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
        <h2>Subscribe</h2>
          <div>
            <h2 class="hidden">Subscribe</h2>
            <div class="formDiv">
              <table class="basicTable">              
                <thead>        
                  <tr>                  
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>       
                    <th>Frequency</th>
                    <th class="hidden">User ID</th>
                    <th><!--Update--></th>
                    <th><!--Delete--></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($subscribers as $subscriber) { ?>
                  <tr>
                    <td><?= $subscriber->uname; ?></td>
                    <td><?= $subscriber->fname; ?></td>
                    <td><?= $subscriber->lname; ?></td>
                    <td><?= $subscriber->frequency; ?></td>
                    <td class="hidden"><?= $subscriber->user; ?></td>
                    <td>
                      <form action="./updateSubscriber.php" method="post">
                        <input type="hidden" name="subscriber_id" value="<?= $subscriber->subscriber_id; ?>"/>
                        <input type="submit" name="updateSubscriber" class="backLink" value="Update"/>
                      </form>
                    </td>
                    <td>
                      <form action="./deleteSubscriber.php" method="post">
                        <input type="hidden" name="subscriber_id" value="<?= $subscriber->subscriber_id; ?>"/>
                        <input type="submit" name="deleteSubscriber" value="Delete" class="backLink"/>
                      </form>
                    </td>                    
                  </tr>         
                  <?php } ?>
                </tbody>
              </table>          
              <div id="addDiv">
                <a href="./addSubscriber.php" id="btnAddSubscriber" class="linkAsButton">Add</a>
              </div>                        
            </div>
          </div>
        </div>
      </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php"?>
  </body>
</html>