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

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager recovery read and delete</title>
    <link rel="stylesheet" href="./css/recoveryInformationMain.css">
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
                <h2>History</h2>
                <div id="optionDiv">
                    <!--<h3>How would you like to recover your personal information?</h3>-->
                    <div class="options">
                        <a href="listLoginHistory.php" id="btnGoLHistory" class="linkAsButton">Login History</a>                
                    </div>                  
                    <div class="options">
                        <a href="pHistory.php" id="btnGoPHistory" class="linkAsButton">Password History</a>
                    </div>
                </div>
              </div>
          </div>
        </main>
        <!--global footer-->
        <?php include "php/footer.php"?>
    </body>
  </html>