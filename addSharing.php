<?php
//File created by Wafa 04/2021
//SESSION VARIABLE
use Codesses\php\Models\{Session, DatabaseTwo, Sharepassword};
require_once "./php/Models/Session.php";
require_once "./php/Models/Sharepassword.php";
require_once "./php/Models/DatabaseTwo.php";
require_once "./library/share-functions.php";

// Get the session object.
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

$dbcon = DatabaseTwo::getDb();
$sp = new Sharepassword();

//for now added a user drop down to insure shared_passwords table is getting updated
$owner_id = $session->getUserId();
$recipients = $sp->getAllusers($dbcon);
$urls = $sp->getAllurlbyId($owner_id, $dbcon);

$successMsg = "";
$invalidMsg = "";

//sharing a password
if(isset($_POST['addSharing'])){

    $owner_id = $_POST['owner'];
    $recipient_id = $_POST['recipient'];
    $url_id = $_POST['url'];

    $sp = new Sharepassword();
    $owner_id = $session->getUserId();
    $addShare= $sp->sharePassword($url_id, $owner_id, $recipient_id, $dbcon);


    if($addShare){
        $successMsg = '<div style="display: block;">
        <h4>Password has been shared!</h4>
        </div>';
    } else {
        $invalidMsg = '<div style="display: block;">
        <h4>Please try again!</h4>
        </div>';
    }

 }


?>

<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Create Sharepassword</title>
    <link rel="stylesheet" href="./css/sharing.css">
    <!--<script src="./js/script.js" async defer></script>-->
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
        <div class="mainDiv">
            <!--side nav-->
        <?php include 'php/sideNav.php' ?>
            <!--Share Password-->
            <div class="content">
                <h2>Share Password </h2>
                <div class="contentBox">
                    <div class="cBox">
                        <form action="" method="POST">
                            <div class="hidden">
                                <label for="owner" class="hidden">Owner_ID</label>
                                <input type="text" name="owner" id="owner" class="hidden" value="<?= $_SESSION['user_id'] ?>" />
                            </div>
                            <label for="recipient">Recipient:</label>
                            <select  name="recipient" class="form-control" id="recipient" >
                                <!--php statment-->
                                <?php echo userDropdown($recipients) ?>
                            </select>
                            <label for="url">Url:</label>
                            <select  name="url" class="form-control" id="url" >
                                <!--php statment-->
                                <?php echo urlDropdown($urls) ?>
                            </select>
                            <button type="submit" name="addSharing" class="submitBtn" id="submitBtn">
                                Share Password
                            </button>
                        </form>
                    </div>
                </div>
                <!--onsubmit message-->
                <?php echo $successMsg; ?>
                <?php echo $invalidMsg; ?>
            </div>
        </div>
    </main>
    <!--global footer-->
    <?php include "php/footer.php"?>
  </body>
</html>

