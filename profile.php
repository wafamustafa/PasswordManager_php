<?php

// File created by Wafa Mustafa 2021/04.
// File edited by Barbara Cam 2021/04.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, profileUser};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/profileUser.php';

$dbconnection = DatabaseTwo::getDb();
$pu = new profileUser();
$user_id = $session->getUserId();
$profileUsers = $pu->getAllUsers($user_id, DatabaseTwo::getDb());

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Profile</title>
    <link rel="stylesheet" href="./css/profile.css">
    <script src="./js/script.js" async defer></script>
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv">
        <!--side nav-->
        <?php include 'php/sideNav.php' ?>
        <div class="content">
          <div>
            <h2>Profile</h2>
            <div class="contentBox">
              <div class="cBox">
                <img src="./img/profile-icon.png" alt="empty image" />
                <?php foreach($profileUsers as $pu) { ?>
                <h3><?= $pu->first_name; ?></h3>
                <?php } ?>
                <p>Member since 2005</p>
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


