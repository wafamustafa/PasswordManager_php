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

$sp = new Sharepassword();

$owner_id = $session->getUserId();
$urls = $sp->getAllurlbyId($owner_id, DatabaseTwo::getDb());

if(isset($_POST['updateSharedPassword'])){
    $sp_id = $_POST['sp_id'];
    //$url_id = $_POST['url_id']; 

    $db = DatabaseTwo::getDb();
    $sp = new Sharepassword();
    $shareByid = $sp->getSharedPasswordById($sp_id, $db);
}

if (isset($_POST['updateShared'])){
    $sp_id = $_POST['sp_id'];
    $url_id = $_POST['url_id']; 
  // var_dump($url_id);
    $db = DatabaseTwo::getDb();
    $sp = new Sharepassword();
    $updateShare = $sp->updateSharedPasswordByUrl($sp_id, $url_id, $db);

    header("Location: listSharing.php");


}

?>


<!DOCTYPE html>
<html>
    <head>
        <!--global head.php-->
        <?php include "php/head.php" ?>
        <title>Pass**** Manager Edit and Delete Sharing</title>
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
                    <h2>Update Shared Password</h2>
                    <div class="cBox2">
                        <div class="cBox">
                            <form action="" method="post">
                                <h5><?= $shareByid->from_user; ?></h5>
                                <?= $shareByid->to_user; ?><br />
                                <label for="url">Url:</label>
                                <!--look into this-->
                                <select  name="url_id" class="form-control" id="url_id" >
                                    <!--php statment-->
                                    <?php echo urlDropdown($urls) ?>
                                </select>
                                <br/>
                                <input type="hidden" name="sp_id" value="<?= $shareByid->sp_id; ?>"/>
                                <input type="submit" class="formEdit" name="updateShared" value="Update"/>
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

