<?php
//File created by Wafa 04/2021

use Codesses\php\Models\{Session, DatabaseTwo, Sharepassword};
require_once "./php/Models/Session.php";
require_once "./php/Models/Sharepassword.php";
require_once "./php/Models/DatabaseTwo.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

//list the shared password
$sp = new Sharepassword();
//connection to databse to access all shared password 
$user_id = $session->getUserId();
$allspass = $sp->listSharedpassword($user_id, DatabaseTwo::getDb());



?>

<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager List Sharing</title>
    <link rel="stylesheet" href="./css/sharing.css">
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
                <h2>Pass**** Sharing</h2>
                <div class="contentBox">
                    <!--listing the shared password-->
                    <?php foreach ($allspass as $shared) { ?>
                    <div class="cBox">
                        <h5><?= $shared->from_user; ?></h5>
                        <?= $shared->to_user; ?><br />
                        <?= $shared->url; ?>: <?= $shared->password; ?>
                        <br/>
                        <form action="./updateSharing.php" method="post">
                            <input type="hidden" name="sp_id" value="<?= $shared->sp_id; ?>"/>
                            <input type="submit" class="formEdit" name="updateSharedPassword" value="Update"/>
                        </form>
                        <form action="./deleteSharing.php" method="post">
                            <input type="hidden" name="sp_id" value="<?= $shared->sp_id; ?>"/>
                            <input type="submit" class="formDelete" name="deleteSharedPassword" value="Delete"/>
                        </form>
                    </div>
                    <!--closing php tag-->
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
<!--global footer-->
<?php include "php/footer.php"?>
  </body>
</html>


