<?php
//File created by Wafa 04/2021
use Codesses\php\Models\{DatabaseTwo, Aboutus};

require "./php/Models/AboutUs.php";
require "./php/Models/DatabaseTwo.php";

$dbcon = DatabaseTwo::getDb();
$a = new Aboutus();
$aboutUs =  $a->getAboutus($dbcon);

?>


<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Home</title>
    <link rel="stylesheet" href="./css/aboutUs.css">
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv">
        <!-- YOUR STUFF GOES HERE-->
        <div class="content">
          <div>
            <h2>Meet the Codesses</h2>
            <div class="contentBox">
            <?php foreach ($aboutUs as $about) { ?>
              <div class="cBox">
                <!--pretty proud of the fact that I created an img path-->
                <img src="./img/<?= $about['img_path'] ?>" alt="Team Profile picture" />
                <h5><?= $about['au_member'] ?></h5>
                <?= $about['au_msg'] ?>
              </div>
              <?php } ?> 
            </div>
            <h4>Take charge of your security.</h4>
            <a href="./listAboutUs.php" id="editAboutus" class="abbBtn">Edit</a>
            <div class="spacer"></div>
          </div>
        </div>
      </div>
    </main>
  <!--global footer-->
  <?php include "php/footer.php"?>
  </body>
</html>


