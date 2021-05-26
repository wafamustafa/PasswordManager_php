<?php
//File created by Wafa 04/2021
use Codesses\php\Models\{DatabaseTwo, AboutUs};

require "./php/Models/AboutUs.php";
require "./php/Models/DatabaseTwo.php";

$au_member = "";
$au_msg = "";
$img_path = "";

if (isset($_POST['updateAbout'])) {
    $au_id = $_POST['au_id'];
    $db = DatabaseTwo::getDb();

    $a = new AboutUs();
    $au = $a->getAboutusById($au_id, $db);

    $au_member =  $au->au_member;
    $au_msg = $au->au_msg;
    $img_path = $au->img_path;
}
if (isset($_POST['updMember'])) {
    $au_member = $_POST['member'];
    $au_msg = $_POST['message'];
    $au_id = $_POST['au_id'];

    $db = DatabaseTwo::getDb();
    $about = new AboutUs();
    $updateAbout = $about->updateAboutus($au_id, $au_member, $au_msg, $img_path, $db);

    if ($updateAbout) {
        header('Location:listAboutUs.php');
        exit;
    } else {
        echo "problem";
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <!--global head.php-->
        <?php include "php/head.php" ?>
        <title>Pass**** Manager Edit or Delete About us member</title>
        <link rel="stylesheet" href="./css/aboutUs.css">
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
                    <h2>Update Member</h2>
                    <div class="cBox">
                        <form name="updateAbout" action="" method="POST">
                            <input type="hidden" name="au_id" value="<?= $au_id; ?>" />
                            <img src="./img/<?= $img_path; ?>" alt="Team Profile picture" />
                            <div class="inputDiv">
                                <label for="member">Member Name</label>
                                <input type="text" name="member" id="member" value="<?= $au_member; ?>" />
                            </div>
                            <div class="inputDiv">
                                <label for="message">Member Title</label>
                                <input type="text" name="message" id="message" value="<?= $au_msg; ?>" />
                            </div>
                            <div class="inputDiv">
                                <input type="submit" name="updMember" value="Update Member" />
                            </div>
                            <div id="backtoAboutus">
                                <a href="./listAboutUs.php" class="backLink">Back to About Us</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    <!--global footer-->
        <?php include "php/footer.php"?>
    </body>
</html>
