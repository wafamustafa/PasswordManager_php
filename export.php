<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Export</title>
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
            <h2>Export Passwords</h2>
            <div class="formDiv">
              <form action="" method="GET">
                <div>
                  <label for="fileOutput" class="fileInputLabel">Choose a File</label>
                  <div class="fileNameDiv"></div>
                  <input class="hidden" id="fileInput" name="fileInput" type="file"/>
                </div>                
                <div class="inputDiv">
                  <input type="submit" value="Export">
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
  
