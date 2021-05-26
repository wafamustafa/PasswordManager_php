<?php

// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{DatabaseTwo, Recovery};

require "./php/Models/Recovery.php";
require "./php/Models/DatabaseTwo.php";

$recover = new recovery();

if (isset($_POST['email'])) {
  $email = $_POST['twostepbar'];
  $db = DatabaseTwo::getDb();
  $r = new recovery();
  $recover = $r->getEmail($email, $db);

  if ($recover) {
    header("Location:recoveryGetQuestion.php");
    exit;

  } else {
    echo "This email does not have an account";
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Home</title>
    <link rel="stylesheet" href="./css/twoStepQuestion.css">
    <script src="./js/script.js" async defer></script>
  </head>
  <body>
    <!--main nav-->
    <?php include 'php/header.php' ?>
    <main>
      <div class="mainDiv">        
        <!-- YOUR STUFF GOES HERE-->
        <div class="content">
          <div>
            <h2>Verification by Question</h2>
            <p>Please enter your e-mail</p>            
            <form action="./recoveryGetQuestion.php" method="POST" class="twostepform">
              <div class="inputDiv" id="getInfo" >
                <div>
                  <input type="text" class="twostepbar" name="twostepbar" value="">
                </div>
                <div>
                  <input type="submit" class="linkAsButton" name="email" value="Enter Email"/>
                </div>
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
