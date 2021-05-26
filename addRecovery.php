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

$r = new Recovery(); 
$answer = '';
$sq_id = '';

//add recovery question and answer
if(isset($_POST['addRecovery'])){
    $sq_id = $_POST['sq_id'];
    $answer = $_POST['answer'];
    $user = $_POST['user'];
     
      $db = DatabaseTwo::getDb();
      $r = new Recovery();       
      $b = $r->addRecovery($sq_id, $answer, $user, $db);

      if($b){
        header("Location: recoveryInformation.php");
        exit;

      } else {
        echo "problem adding recovery information";
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
                <!-- <input type="radio" name="recoveryOptions" id="questions" value="questions"/> 
                <label for="questions">Recovery Questions</label> -->                
                <legend>Select first recovery question</legend>            
                <select id="recoveryOne" name="sq_id">
                  <option value="0" >Choose one security question</option>
                  <option value="1" <?= ($sq_id == '1') ? 'selected' : ''; ?>>What is your maternal grandmother's maiden name?</option>
                  <option value="2"<?= ($sq_id == '2') ? 'selected' : ''; ?>>In what town or city was your first full time job?</option>
                  <option value="3"<?= ($sq_id == '3') ? 'selected' : ''; ?>>What was the house number and street name you lived in as a child?</option> 
                  <option value="4"<?= ($sq_id == '4') ? 'selected' : ''; ?>>What primary school did you attend?</option>
                  <option value="5"<?= ($sq_id == '5') ? 'selected' : ''; ?>>What was your childhood nickname?</option>
                  <option value="6"<?= ($sq_id == '6') ? 'selected' : ''; ?>>What is the name of your favorite childhood teacher?</option>  
                </select>
                <div class="inputDiv">
                 <label for="answer">Answer</label>
                 <input type="text" name="answer" id="answer" />
                </div>
                <div class="inputDiv">
                 <label for="user" class="hidden">User_ID</label>
                 <input type="text"  class="hidden" name="user" id="user" value="<?= $_SESSION['user_id'] ?>" />
                </div>
                 <!-- <legend>Select second recovery question</legend>
                 <select id="recoveryTwo" name="recoveryOne">
                    <option value="0B">Choose a second security question</option>
                    <option value="1B">What primary school did you attend?</option>
                    <option value="2B">What was your childhood nickname?</option>
                    <option value="3B">What is the name of your favorite childhood teacher?</option>                     
                </select>
                <div class="inputDiv">
                  <input type="text" name="questionTwo"  id="questionTwo" />
                </div> -->
                <!-- <div>Or</div>
                <input type="radio" name="recoveryOptions" id="byEmail" value="byEmail"/> 
                <label for="byEmail">Recovery by Email</label>
                <div class="inputDiv">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" />
                </div>               -->
                <div class='bt'>
                  <a href="./recoveryInformation.php" id="btn_back" class="backLink">Back</a>
                  <button type="submit" name="addRecovery" id="btn-submit" class="backLink">Add</button>
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