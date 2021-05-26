<?php

// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get the session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, PasswordHistory};

require_once "./php/Models/PasswordHistory.php";
require_once "./php/Models/DatabaseTwo.php";

//list the password history and filter by user id
$dbconnection = DatabaseTwo::getDb();
$ph = new passwordHistory();
$user_id = $session->getUserId();
$phistories = $ph->getAllPasswordHistory($user_id, DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Password History</title>
    <link rel="stylesheet" href="./css/pHistory.css">
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
                <h2>Pass** History</h2>
                <div>
                  <h2 class="hidden">Password History</h2>                   
                  <!-- <div class="formDiv">             -->
                    <table class="basicTable">
                      <thead>
                        <th>URL</th>
                        <th>Action</th>
                        <th>Old Pass**</th>
                        <th>New Pass**</th>
                        <th>Old Hint</th>
                        <th>New Hint</th>
                        <th>Date</th>
                      </thead>
                     <tbody>
                     <?php foreach($phistories as $phistory) { ?>
                        <tr>
                          <td><?= $phistory->url; ?></td>
                          <td><?= $phistory->action; ?></td>
                          <td><?= $phistory->old_password; ?></td>
                          <td><?= $phistory->new_password; ?></td>
                          <td><?= $phistory->old_password_hint; ?></td>
                          <td><?= $phistory->new_password_hint; ?></td>
                          <td><?= $phistory->timestamp; ?></td>
                          <td>
                            <form action="./deletePHistory.php" method="post">
                              <input type="hidden" name="ph_id" value="<?= $phistory->id; ?>"/>
                              <input type="submit" class="phDelete" name="deletePHistory" value="Delete"/>
                            </form>
                         </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  <!-- </div>                 -->
                </div>
              </div>
            </div>
          </main>
          <!--global footer-->
          <?php include "php/footer.php"?>
        </body>
      </html>