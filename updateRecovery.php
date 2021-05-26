<?php

// File created by Barbara Cam 2021/04.

use Codesses\php\Models\{Session};
require_once "./php/Models/Session.php";

// Get session
$session = Session::getInstance();

// If the user is not logged in, redirect to the login page.
if( !$session->hasUser() ) {
  header( "Location: login.php" );
  exit;
}

use Codesses\php\Models\{DatabaseTwo, Recovery};

require_once './php/Models/DatabaseTwo.php';
require_once './php/Models/Recovery.php';

$sq_id2 = $answer = $user = "";
$r2 = new recovery();

//get recovery information from the list and database
if(isset($_POST['updateRecovery'])){
  $id= $_POST['sa_id'];
    
    $db = DatabaseTwo::getDb();
    $r = new recovery();
    $recovery = $r->getRecoveryById($id, $db);
      
    $user = $recovery->user;
    $sq_id2 = $recovery->sq_id;
    $answer = $recovery->answer;
}

//update and change the recovery information into the database
if(isset($_POST['updRecovery'])){
    $id= $_POST['rid'];
    $sq_id = $_POST['sq_id'];
    $user = $_POST['user'];
    $answer = $_POST['answer'];    

    $db = DatabaseTwo::getDb();    
    $r = new recovery();
    $count = $r->updateRecovery($id, $sq_id, $answer, $user, $db);
      if($count){
        header('Location: recoveryInformation.php');
        exit;
      } else {
        echo "Updating failing";
      }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <!--global head.php-->
    <?php include "php/head.php" ?>
    <title>Pass**** Manager Recovery Create and update</title>
    <link rel="stylesheet" href="./css/recoveryInformation.css">
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
        <h2>Recovery Question</h2>
          <div>
            <h2 class="hidden">Recovery Information</h2>
            <div class="formDiv">
              <form action="" method="POST"> 
                <input type="hidden" name="rid" value="<?= $id ?>"/>
                <!-- <input type="radio" name="recoveryOptions" id="questions" value="questions"/> 
                <label for="questions">Recovery Questions</label> -->
                 <legend>Select first recovery question</legend>            
                <select id="recoveryOne" name="sq_id">
                  <option value="0" >Choose one security question</option>
                  <option value="1" <?= ($sq_id2 == '1') ? 'selected' : ''; ?>>What is your maternal grandmother's maiden name?</option>
                  <option value="2"<?= ($sq_id2 == '2') ? 'selected' : ''; ?>>In what town or city was your first full time job?</option>
                  <option value="3"<?= ($sq_id2 == '3') ? 'selected' : ''; ?>>What was the house number and street name you lived in as a child?</option> 
                  <option value="4"<?= ($sq_id2 == '4') ? 'selected' : ''; ?>>What primary school did you attend?</option>
                  <option value="5"<?= ($sq_id2 == '5') ? 'selected' : ''; ?>>What was your childhood nickname?</option>
                  <option value="6"<?= ($sq_id2 == '6') ? 'selected' : ''; ?>>What is the name of your favorite childhood teacher?</option>  
                </select>
                <div class="inputDiv">
                  <label for="answer">Answer</label>
                  <input type="text" name="answer" id="answer" value= "<?= $answer; ?>"/>
                </div>
                <div class="inputDiv">
                  <label for="user" class="hidden">User_ID</label>
                  <input type="text" class="hidden" name="user" id="user" value= "<?= $user; ?>" />
                </div>                            
                <div class='bt'>
                  <a href="./recoveryInformation.php" id="btn_back" class="backLink">Back</a>
                  <button type="submit" name="updRecovery" id="btn-submit" class="backLink">Add</button>
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