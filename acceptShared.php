<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Accept Shared Password</title>
    <link rel="stylesheet" href="./css/login.css">
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
          <div>
            <h2 class="hidden">Accept Shared Password</h2>
            <div class="formDiv">
              <p>Accept password for <span id="sharedUrlSpan"></span> from <span id="sharingUserSpan"></span>?</p>
              <form action="" method="POST">
                <div class="inputDiv">
                  <a class="linkAsButton" href="index.html">Cancel</a>
                  <input type="submit" value="Accept">
                </div>  
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
  
