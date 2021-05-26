<?php
// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Recovery};

require_once "./php/Models/Recovery.php";
require_once "./php/Models/DatabaseTwo.php";

//list from the recovery information filtered by user
$dbconnection = DatabaseTwo::getDb();
$r = new recovery();
$user_id = $session->getUserId();
$recoveries = $r->getAllRecoveries($user_id, DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager recovery read and delete</title>
    <link rel="stylesheet" href="./css/recoveryInformation.css">
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
                <h2>Recovery Question</h2>
                <div>
                  <h2 class="hidden">Recovery Questions</h2>                   
                  <div class="formDiv">            
                    <table class="basicTable">
                      <thead>
                        <th class="hidden">Answer ID</th>
                        <th>Username</th>
                        <th>Question</th>
                        <th>Answer</th>                                          
                      </thead>
                      <tbody>
                      <?php foreach($recoveries as $recovery) { ?>
                        <tr>
                          <td class="hidden"><?= $recovery->id; ?></td>
                          <td><?= $recovery->uname; ?></td>
                          <td><?= $recovery->question; ?></td>
                          <td><?= $recovery->answer; ?></td>                                                                 
                          <td>
                            <form action="./updateRecovery.php" method="post">
                              <input type="hidden" name="sa_id" value="<?= $recovery->id; ?>"/>
                              <input type="submit" class="backLink" name="updateRecovery" value="Update"/>
                            </form>
                          </td>
                          <td>
                            <form action="./deleteRecovery.php" method="post">
                              <input type="hidden" name="sa_id" value="<?= $recovery->id; ?>"/>
                              <input type="submit" class="backLink" name="deleteRecovery" value="Delete"/>
                            </form>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <div id="addDiv">
                      <a href="./addRecovery.php" id="btnAddRecovery" class="linkAsButton">Add</a>
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