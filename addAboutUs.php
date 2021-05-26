<?php
//File created by Wafa 04/2021

use Codesses\php\Models\{Aboutus, DatabaseTwo};

require "./php/Models/AboutUs.php";
require "./php/Models/DatabaseTwo.php";

$newAbout = new Aboutus();

if (isset($_POST['addMember'])) {

    $img_path = $_POST['imgpath'];
    $au_member = $_POST['member'];
    $au_msg = $_POST['message'];

    $db = DatabaseTwo::getDb();
    $au = new Aboutus();
    $newAbout = $au->addAboutUs($au_member, $au_msg, $img_path, $db);

    if ($newAbout) {
        header("Location:listAboutUs.php");
        exit;
    } else {
        echo "Problem adding Member";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <!--global head.php-->
  <?php include "php/head.php"?>
  <title>Pass**** Manager Add AboutUs</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/aboutUs.css">
  <script src="./js/script.js" async defer></script>
</head>

<body>
  <!--main nav-->
  <?php include 'php/header.php' ?>
    <main>
        <div class="mainDiv">
            <div class="content">
                <h2 class="hidden">Add New Member</h2>
                <div class="formDiv2">
                    <form name="addMember" action="" method="POST">
                        <div class="inputDiv">
                            <label for="img_path">Image</label>
                            <input type="text" name="imgpath" id="imgpath" value="" />
                        </div>
                        <div class="inputDiv">
                            <label for="member">Member Name</label>
                            <input type="text" name="member" id="member" value="" />
                        </div>
                        <div class="inputDiv">
                            <label for="message">Member Title</label>
                            <input type="text" name="message" id="message" value="" />
                        </div>
                        <div class="inputDiv">
                            <input type="submit" name="addMember" value="Add Member" />
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
  <?php include "php/footer.php" ?>
</body>

</html>